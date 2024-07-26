<?php

namespace App\Http\Controllers;

use App\Models\Productmodel;
use App\Models\Pesananmodel;
use Illuminate\Http\Request;
use App\Models\Cartmodel;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use carbon\carbon;

class PesananController extends Controller
{
    public function indexcart()
    {
        // Ambil semua item cart dari database dengan left join ke tabel products
        $cart = DB::table('tbl_cart')
            ->leftJoin('tbl_product', 'tbl_cart.product_id', '=', 'tbl_product.id')
            ->select(
                'tbl_cart.*',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'tbl_product.deskripsi'
            )
            ->where('tbl_cart.user_id', auth()->user()->id)
            ->where('tbl_cart.status_cart', 'pending')
            ->paginate(10);

        // Tampilkan view cart.blade.php dengan data $cartItems
        return view('cart', compact('cart'));
    }

    public function storecart(Request $request)
    {
        // Validasi request jika diperlukan
        $product = Productmodel::find($request->product_id);
        if ($product) {
            // Hitung total belanja
            $totalbelanja = $product->harga * $request->quantity;

            // Tambahkan atau update item cart
            $cart = Cartmodel::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'status_cart' => 'pending',
                ],
                [
                    'quantity' => $request->quantity,
                    'totalbelanja' => $totalbelanja
                ]
            );

            // Redirect kembali ke halaman cart atau halaman produk dengan pesan sukses
            return redirect(url('/cart'))->with('success', 'Product added to cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found.');
    }


    public function updatecart(Request $request, $id)
    {
        // Cari item cart berdasarkan $id
        $cartItem = Cartmodel::findOrFail($id);
        if ($cartItem->user_id == auth()->user()->id) {
            // Update quantity
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        // Redirect kembali ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function destroycart($id)
    {
        // Cari dan hapus item cart berdasarkan $id
        $cartItem = Cartmodel::findOrFail($id);
        if ($cartItem->user_id == auth()->user()->id) {
            $cartItem->delete();
        }

        // Redirect kembali ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    ////////////////////////////////////////////////////////////////////////////////////

    public function indexcekout()
    {
        // Ambil semua item cart dari database dengan relasi ke tabel product dan users
        $cartItems = DB::table('tbl_cart')
            ->leftJoin('tbl_product', 'tbl_cart.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_cart.user_id', '=', 'users.id')
            ->select('tbl_cart.*', 'tbl_product.namaproduct', 'tbl_product.harga', 'tbl_product.gambar', 'users.name')
            ->where('tbl_cart.user_id', auth()->user()->id)
            ->get();

        // Hitung total belanja
        $subtotal = $cartItems->sum(function ($item) {
            return $item->harga * $item->quantity;
        });

        // Asumsi biaya pengiriman tetap
        $deliveryFee = 10000; // Contoh biaya pengiriman
        $discount = 0; // Contoh diskon, jika ada

        $total = $subtotal + $deliveryFee - $discount;

        return view('checkout', compact('cartItems', 'subtotal', 'deliveryFee', 'discount', 'total'));
    }

    public function storecekout(Request $request)
    {
        // Ambil data pengguna yang sedang masuk dari tabel users
        $user = auth()->user();

        // Ambil semua item cart dari database dengan left join ke tabel product
        $cartItems = DB::table('tbl_cart')
            ->leftJoin('tbl_product', 'tbl_cart.product_id', '=', 'tbl_product.id')
            ->select('tbl_cart.*', 'tbl_product.namaproduct', 'tbl_product.harga')
            ->where('tbl_cart.user_id', $user->id)
            ->where('tbl_cart.status_cart', 'pending')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung total belanja
        $subtotal = $cartItems->sum(function ($item) {
            return $item->harga * $item->quantity;
        });

        // Asumsi biaya pengiriman tetap
        $deliveryFee = 10000; // Contoh biaya pengiriman
        $discount = 0; // Contoh diskon, jika ada

        $totalbelanja = $subtotal + $deliveryFee - $discount;

        // Buat kode pesanan unik
        $kodepesanan = 'KDP-' . Str::random(8);

        // Ambil product_id dari item pertama dalam keranjang
        $product_id = $cartItems->first()->product_id;
        $cart_id = $cartItems->first()->id;

        // Buat Pesanan
        $checkout = Pesananmodel::create([
            'name' => $user->name, // Ambil dari tabel users
            'address' => $user->address, // Ambil dari tabel users
            'no_telp' => $user->no_telp, // Ambil dari tabel users
            'email' => $user->email, // Ambil dari tabel users
            'totalbelanja' => $totalbelanja,
            'tanggal_pesanan' => now(),
            'kodepesanan' => $kodepesanan,
            'product_id' => $product_id,
            'user_id' => $user->id,
            'cart_id' => $cart_id
        ]);

        // Masukkan detail pesanan ke dalam tabel tbl_pesanan_saya
        foreach ($cartItems as $item) {
            DB::table('tbl_pesanan_saya')->insert([
                'kodepesanan' => $kodepesanan,
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'harga' => $item->harga,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Update status cart menjadi paid dan simpan cart_id terakhir di tbl_pesanan
        DB::table('tbl_cart')
            ->where('user_id', $user->id)
            ->update(['status_cart' => 'paid']);

        // Cek apakah pesanan berhasil dibuat
        if ($checkout) {
            // Simpan cart_id terakhir ke tbl_pesanan
            $lastCartItem = $cartItems->last();
            $checkout->update(['cart_id' => $lastCartItem->id]);

            $request->session()->put('checkout', $checkout);
            $request->session()->put('cartItems', $cartItems);
            $request->session()->put('subtotal', $subtotal);
            $request->session()->put('deliveryFee', $deliveryFee);
            $request->session()->put('discount', $discount);
            $request->session()->put('totalbelanja', $totalbelanja);

            // Redirect ke halaman sukses
            return redirect()->to('/checkout/success');
        } else {
            return back()->with('error', 'Checkout gagal, silakan coba lagi.');
        }
    }

    public function success(Request $request)
    {
        // Ambil data dari session
        $checkout = $request->session()->get('checkout');
        $cartItems = $request->session()->get('cartItems');
        $subtotal = $request->session()->get('subtotal');
        $deliveryFee = $request->session()->get('deliveryFee');
        $discount = $request->session()->get('discount');
        $totalbelanja = $request->session()->get('totalbelanja');

        // Return view dengan data yang lengkap
        return view('success', compact('checkout', 'cartItems', 'subtotal', 'deliveryFee', 'discount', 'totalbelanja'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////

    public function indexdatapesanan()
    {
        $listpesananmasuk = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.status_pesanan', 'pending')
            ->paginate(10);

        $param = [
            "modulname" => "datapesananmasuk",
            "title" => "Pesanan Masuk",
            "listpesananmasuk" => $listpesananmasuk
        ];

        return view('admin.orders.datapesananmasuk', $param);
    }


    public function hapusdatapesanan(Request $request)
    {
        $pesanan = PesananModel::findOrFail($request->id);
        Storage::delete($pesanan->gambar);
        $pesanan->delete();
        return redirect(url('orders.datapesananmasuk'))->with('success', 'Pesanan berhasil dihapus!');
    }

    public function showpesanan($id)
    {

        $pesanan = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.id', $id)
            ->first();

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('admin.orders.detailpesanan', compact('pesanan'));
    }
    public function dikonfirmasi()
    {
        $listpesanandikonfirmasi = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.status_pesanan', 'dikonfirmasi')
            ->paginate(10);

        return view('admin.orders.datapesanandikonfirmasi', compact('listpesanandikonfirmasi'));
    }

    public function konfirmasi($id)
    {
        $pesanan = PesananModel::find($id);
        if ($pesanan) {
            $pesanan->status_pesanan = 'dikonfirmasi';
            $pesanan->save();
            return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
    public function kemas($id)
    {
        $pesanan = PesananModel::find($id);
        if ($pesanan) {
            $pesanan->status_pesanan = 'dikemas';
            $pesanan->save();
            return redirect()->back()->with('success', 'Pesanan berhasil dikemas.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
    public function indexDikemas()
    {
        $listpesanandikemas = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.status_pesanan', 'dikemas')
            ->paginate(10);
        return view('admin.orders.datapesanandikemas', compact('listpesanandikemas'));
    }
    public function indexDikirim()
    {
        $listpesanandikirim = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.status_pesanan', 'dikirim')
            ->paginate(10);
        return view('admin.orders.datapesanandikirim', compact('listpesanandikirim'));
    }
    public function kirim($id)
    {
        $pesanan = PesananModel::find($id);
        if ($pesanan) {
            $pesanan->status_pesanan = 'dikirim';
            $pesanan->save();
            return redirect()->back()->with('success', 'Pesanan berhasil dikrim.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
    public function indexSelesai()
    {
        $listpesanandiselesaikan = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->where('tbl_pesanan.status_pesanan', 'selesai')
            ->paginate(10);
        return view('admin.orders.datapesananselesai', compact('listpesanandiselesaikan'));
    }
    public function selesai($id)
    {
        $pesanan = PesananModel::find($id);
        if ($pesanan) {
            $pesanan->status_pesanan = 'selesai';
            $pesanan->save();
            return redirect()->back()->with('success', 'Pesanan Selesai.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    public function indexorder()
    {
        // Mengambil semua pesanan dari database
        $orders = PesananModel::all();

        return view('orders.index', compact('orders'));
    }

    //////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    public function dashboard()
    {
        // Ambil semua pesanan
        $allOrders = DB::table('tbl_pesanan')
            ->leftJoin('tbl_cart', 'tbl_pesanan.cart_id', '=', 'tbl_cart.id')
            ->leftJoin('tbl_product', 'tbl_pesanan.product_id', '=', 'tbl_product.id')
            ->leftJoin('users', 'tbl_pesanan.user_id', '=', 'users.id')
            ->select(
                'tbl_pesanan.id',
                'tbl_pesanan.tanggal_pesanan',
                'tbl_pesanan.kodepesanan',
                'tbl_pesanan.status_pesanan',
                'tbl_cart.quantity',
                'tbl_cart.totalbelanja',
                'tbl_product.namaproduct',
                'tbl_product.harga',
                'tbl_product.gambar',
                'users.name',
                'users.email',
                'users.phone'
            )
            ->get();

        // Ambil pesanan bulan ini
        $monthlyOrders = DB::table('tbl_pesanan')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        // Ambil pesanan tahun ini
        $yearlyOrders = DB::table('tbl_pesanan')
            ->whereYear('created_at', now()->year)
            ->get();

        // Hitung jumlah pesanan
        $totalOrders = $allOrders->count();
        $totalMonthlyOrders = $monthlyOrders->count();
        $totalYearlyOrders = $yearlyOrders->count();

        // Hitung total penjualan
        $totalSales = $allOrders->sum('totalbelanja');
        $monthlySales = $monthlyOrders->sum('totalbelanja');
        $yearlySales = $yearlyOrders->sum('totalbelanja');

        // Siapkan data untuk chart bulanan
        $monthlyOrdersData = $monthlyOrders->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d'); // Mengelompokkan berdasarkan hari dalam bulan
        })->map(function ($row) {
            return $row->count();
        });

        // Siapkan data untuk chart tahunan
        $yearlyOrdersData = $yearlyOrders->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m'); // Mengelompokkan berdasarkan bulan dalam tahun
        })->map(function ($row) {
            return $row->count();
        });

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalMonthlyOrders',
            'totalYearlyOrders',
            'totalSales',
            'monthlySales',
            'yearlySales',
            'allOrders',
            'monthlyOrdersData',
            'yearlyOrdersData'
        ));
    }
}
