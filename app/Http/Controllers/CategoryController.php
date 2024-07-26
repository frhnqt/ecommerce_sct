<?php

namespace App\Http\Controllers;

use App\Models\Categorymodel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function indexdatacategory()
    {
        $listcategory = Categorymodel::paginate(10);

        $param = [
            "modulname" => "datacategory",
            "title" => "Data Category",
            "listcategory" => $listcategory
        ];

        return view('admin.datacategory', $param);
    }

    public function addcategory()
    {
        $param = [
            "modulname" => "addcategory",
            "title" => "Input Data Category"
        ];
        return view('admin.formaddcategory', $param);
    }

    public function savedatacategory(Request $request)
    {
        $request->validate([
            'namacategory' => 'required|unique:tbl_category,namacategory|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('gambar')->store('public/categorys');

        $datacategory = [
            'namacategory' => $request->input('namacategory'),
            'gambar' => $path
        ];

        Categorymodel::create($datacategory);

        return redirect(url('datacategory'))->with('success', 'Category berhasil ditambahkan!');
    }

    public function editdatacategory($id)
    {
        $datacategory = Categorymodel::findOrFail($id);

        $param = [
            "modulname" => "editcategory",
            "title" => "Edit Data Category",
            "datacategory" => $datacategory
        ];

        return view('admin.formeditcategory', $param);
    }

    public function saveeditdatacategory(Request $request, $id)
    {
        $datacategory = Categorymodel::findOrFail($id);

        // Validasi input
        $request->validate([
            'namacategory' => 'required|unique:tbl_category,namacategory,' . $id . '|max:255',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Data untuk update
        $datacategoryData = [
            'namacategory' => $request->input('namacategory')
        ];

        // Jika gambar diupload, simpan dan tambahkan ke data update
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/categorys');
            $datacategoryData['gambar'] = $path;
        }

        // Update data kategori
        $datacategory->update($datacategoryData);

        return redirect(url('datacategory'))->with('success', 'Category berhasil diperbarui!');
    }

    public function hapusdatacategory(Request $request)
    {
        Categorymodel::destroy($request->id);
        return redirect(url('datacategory'));
    }
}
