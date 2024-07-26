<?php

namespace App\Http\Controllers;

use App\Models\Categorymodel;
use App\Models\Merkmodel;
use App\Models\Productmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function indexdataproduct()
    {
        $listproduct = DB::table('tbl_product')
            ->leftJoin('tbl_merk', 'tbl_product.merkid', '=', 'tbl_merk.id')
            ->leftJoin('tbl_category', 'tbl_product.categoryid', '=', 'tbl_category.id')
            ->select('tbl_product.*', 'tbl_merk.namamerk', 'tbl_category.namacategory')
            ->paginate(10);

        $param = [
            "modulname" => "dataproduct",
            "title" => "Data Product",
            "listproduct" => $listproduct
        ];

        return view('admin.dataproduct', $param);
    }

    public function adminaddproduct()
    {
        $listmerk = Merkmodel::pluck('namamerk', 'id');
        $listcategory = Categorymodel::pluck('namacategory', 'id');
        
        $param = [
            "modulname" => "addproduct",
            "title" => "Input Data Product",
            "listmerk" => $listmerk,
            "listcategory" => $listcategory
        ];
        
        return view('admin.formaddproduct', $param);
    }

    public function savedataproduct(Request $request)
    {
        $request->validate([
            'kodeproduct' => 'required|string|max:255|unique:tbl_product,kodeproduct',
            'namaproduct' => 'required|string|max:255',
            'stok' => 'required|integer',
            'merk' => 'required|exists:tbl_merk,id',
            'category' => 'required|exists:tbl_category,id',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:5000',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'nullable|integer|min:0'
        ]);

        $path = $request->file('gambar')->store('public/products');

        $dataproduct = [
            'kodeproduct' => $request->input('kodeproduct'),
            'namaproduct' => $request->input('namaproduct'),
            'stok' => $request->input('stok'),
            'merkid' => $request->input('merk'),
            'categoryid' => $request->input('category'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' => $path,
            'quantity' => $request->input('quantity', 0)
        ];

        Productmodel::create($dataproduct);

        return redirect(url('dataproduct'))->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editdataproduct($id)
    {
        $dataproduct = Productmodel::findOrFail($id);

        $listmerk = Merkmodel::pluck('namamerk', 'id');
        $listcategory = Categorymodel::pluck('namacategory', 'id');
        
        $param = [
            "modulname" => "editproduct",
            "title" => "Edit Data Product",
            "dataproduct" => $dataproduct,
            "listmerk" => $listmerk,
            "listcategory" => $listcategory
        ];

        return view('admin.formeditproduct', $param);
    }

    public function saveeditdataproduct(Request $request, $id)
    {
        $request->validate([
            'kodeproduct' => 'required|string|max:255|unique:tbl_product,kodeproduct,' . $id,
            'namaproduct' => 'required|string|max:255',
            'stok' => 'required|integer',
            'merk' => 'required|exists:tbl_merk,id', // Validasi bahwa merk yang dipilih ada dalam tabel merk
            'category' => 'required|exists:tbl_category,id', // Validasi bahwa category yang dipilih ada dalam tabel category
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|max:5000',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $dataproduct = [
            'kodeproduct' => $request->input('kodeproduct'),
            'namaproduct' => $request->input('namaproduct'),
            'stok' => $request->input('stok'),
            'merkid' => $request->input('merk'),
            'categoryid' => $request->input('category'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi')
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/products');
            $dataproduct['gambar'] = $path;
        }

        Productmodel::where('id', $id)->update($dataproduct);

        return redirect(url('dataproduct'))->with('success', 'Produk berhasil diperbarui!');
    }

    public function hapusdataproduct(Request $request)
    {
        $product = Productmodel::findOrFail($request->id);
        Storage::delete($product->gambar);
        $product->delete();
        return redirect(url('dataproduct'))->with('success', 'Produk berhasil dihapus!');
    }

    public function adminshowdataproduct($id)
    {
        $product = DB::table('tbl_product')
            ->leftJoin('tbl_merk', 'tbl_product.merkid', '=', 'tbl_merk.id')
            ->leftJoin('tbl_category', 'tbl_product.categoryid', '=', 'tbl_category.id')
            ->select('tbl_product.*', 'tbl_merk.namamerk', 'tbl_category.namacategory')
            ->where('tbl_product.id', $id)
            ->first();

        $param = [
            "modulname" => "detailproduct",
            "title" => "Detail Product",
            "product" => $product
        ];

        return view('admin.detailproduct', $param);
    }

    ////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////
    
    public function indexshop(Request $request)
    {
        // Fetch all categories
        $categories = Categorymodel::all();

        // Get the selected category from request
        $selectedCategory = $request->input('category');

        // Fetch products based on the selected category, or all products if no category is selected
        if ($selectedCategory) {
            $products = Productmodel::where('category_id', $selectedCategory)->get();
        } else {
            $products = Productmodel::all();
        }

        return view('shop', compact('products', 'categories', 'selectedCategory'));
    }

    public function detailproductuser($id)
    {
        $product = Productmodel::find($id);
        return view('product', compact('product'));
    }
}