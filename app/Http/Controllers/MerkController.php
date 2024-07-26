<?php

namespace App\Http\Controllers;

use App\Models\Merkmodel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MerkController extends Controller
{
    public function indexdatamerk()
    {
        $listmerk = Merkmodel::paginate(10);

        $param = [
            "modulname" => "datamerk",
            "title" => "Data Merk",
            "listmerk" => $listmerk
        ];

        return view('admin.datamerk', $param);
    }

    public function addmerk()
    {
        $param = [
            "modulname" => "addmerk",
            "title" => "Input Data Merk"
        ];
        return view('admin.formaddmerk', $param);
    }

    public function savedatamerk(Request $request)
    {
        $request->validate([
            'namamerk' => 'required|unique:tbl_merk,namamerk|max:255',
        ]);

        $datamerk = [
            'namamerk' => $request->input('namamerk'),
        ];

        Merkmodel::create($datamerk);

        return redirect(url('datamerk'))->with('success', 'Merk berhasil ditambahkan!');
    }

    public function editdatamerk($id)
    {
        $datamerk = Merkmodel::findOrFail($id);

        $param = [
            "modulname" => "editmerk",
            "title" => "Edit Data Merk",
            "datamerk" => $datamerk
        ];

        return view('admin.formeditmerk', $param);
    }

    public function saveeditdatamerk(Request $request, $id)
{
    $datamerk = Merkmodel::findOrFail($id);

    // Validasi input
    $request->validate([
        'namamerk' => [
            'required',
            'max:255',
            Rule::unique('tbl_merk', 'namamerk')->ignore($id),
        ],
    ]);

    // Jika data yang diinput sama dengan data yang sudah ada
    if ($request->namamerk === $datamerk->namamerk) {
        return redirect(url('datamerk'))->with('success', 'Tidak ada perubahan yang dilakukan.');
    }

    // Lakukan update jika validasi lolos
    $datamerk->update([
        'namamerk' => $request->namamerk,
    ]);

    return redirect(url('datamerk'))->with('success', 'Merk berhasil diperbarui!');
}


    public function hapusdatamerk(Request $request)
    {
        Merkmodel::destroy($request->id);
        return redirect(url('datamerk'))->with('success', 'Merk berhasil dihapus!');
    }
}