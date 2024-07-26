<?php

namespace App\Http\Controllers;

use App\Models\Productmodel;
use Illuminate\Http\Request;
use App\Models\Wishlistmodel;

class WishlistController extends Controller
{
    public function indexwishlist()
    {
        // Ambil semua item wishlist dari database
        $wishlists = Wishlistmodel::with('product')->get();

        // Tampilkan view wishlist.blade.php dengan data $wishlists
        return view('wishlist', compact('wishlists'));
    }

    public function storewishlist(Request $request)
    {
        // Validasi request jika diperlukan
        $product = Productmodel::find($request->product_id);
        if ($product) {
        // Buat item wishlist baru berdasarkan input dari form
        Wishlistmodel::create([
            'user_id' => auth()->user()->id, // Anda bisa sesuaikan dengan cara autentikasi yang Anda gunakan
            'product_id' => $request->product_id,
        ]);
    }

        // Redirect kembali ke halaman wishlist atau halaman produk dengan pesan sukses
        return redirect(url('wishlist.index'))->with('success', 'Product added to wishlist successfully!');
    }

    public function destroywishlist($id)
    {
        // Cari dan hapus item wishlist berdasarkan $id
        Wishlistmodel::findOrFail($id)->delete();

        // Redirect kembali ke halaman wishlist dengan pesan sukses
        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist successfully!');
    }
}
