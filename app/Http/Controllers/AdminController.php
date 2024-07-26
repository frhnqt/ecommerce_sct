<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function indexdataadmin()
{
    // Ambil user dengan role_id 2 saja (admin)
    $listadmin = User::where('role_id', 2)->paginate(10);

    $param = [
        "modulname" => "dataadmin",
        "title" => "Data Admin",
        "listadmin" => $listadmin
    ];

    return view('admin.dataadmin', $param);
}

    public function addadmin()
    {
        $param = [
            "modulname" => "addadmin",
            "title" => "Input Data Admin"
        ];

        return view('admin.formaddadmin', $param);
    }

    public function savedataadmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:30|unique:users,email', // Pastikan email unik
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|min:1|max:15',
            'alamat' => 'required|string|max:100', // Nullable jika alamat tidak wajib
            'phone' => 'nullable|numeric|digits_between:10,20' // Nullable jika nomor telepon tidak wajib
        ]);
        
        $dataadmin = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
        ];
        
        User::create($dataadmin);

        return redirect(url('dataadmin'))->with('success', 'Admin berhasil ditambahkan.');
    }

    public function editdataadmin($id)
    {
        $dataadmin = User::findOrFail($id);

        // Pastikan admin hanya bisa mengedit data mereka sendiri
        if (Auth::id() != $id && Auth::user()->role_id != 1) {
            return redirect(url('dataadmin'))->with('error', 'Anda tidak memiliki hak untuk mengedit data ini.');
        }

        $param = [
            "modulname" => "editdataadmin",
            "title" => "Edit Data Admin",
            "dataadmin" => $dataadmin
        ];

        return view('admin.formeditadmin', $param);
    }

    public function saveeditdataadmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:30',
            'password' => 'required|string|min:8|confirmed', // Password boleh kosong saat mengedit
            'phone' => 'required|numeric|digits_between:10,20', // Nullable jika nomor telepon tidak wajib
            'alamat' => 'required|string|max:100', // Alamat boleh kosong
            'role_id' => 'nullable|integer|min:1|max:15', // Role ID boleh diabaikan jika tidak diubah
        ]);
    
        // Pastikan admin hanya bisa mengedit data mereka sendiri
        if (Auth::id() != $id && Auth::user()->role_id != 1) {
            return redirect(url('dataadmin'))->with('error', 'Anda tidak memiliki hak untuk mengedit data ini.');
        }
    
        $dataadmin = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
        ];
    
        // Hanya tambahkan role_id jika ada
        if ($request->filled('role_id')) {
            $dataadmin['role_id'] = $request->input('role_id');
        }
    
        // Hanya perbarui password jika ada perubahan
        if ($request->filled('password')) {
            $dataadmin['password'] = Hash::make($request->input('password'));
        }
    
        User::where('id', $id)->update($dataadmin);
    
        return redirect(url('dataadmin'))->with('success', 'Data admin berhasil diperbarui.');
    }

    

    public function hapusdataadmin(Request $request)
    {
        User::destroy($request->id);
        return redirect(url('admin.dataadmin'))->with('success', 'Data admin berhasil dihapus.');
    }

}