<?php

namespace App\Http\Controllers;

use App\Models\User; // Menggunakan model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function indexdatacustomer()
    {
        // Mengambil semua data user dengan role_id = 3
        $listcustomer = User::where('role_id', 3)->paginate(10);

        $param = [
            "modulname" => "datacustomer",
            "title" => "Data Customer",
            "listcustomer" => $listcustomer
        ];

        return view('admin.datacustomer', $param);
    }

    public function addcustomer()
    {
        $param = [
            "modulname" => "addcustomer",
            "title" => "Input Data Customer"
        ];
        return view('admin.formaddcustomer', $param);
    }

    public function savedatacustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:30|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|in:1,2,3',
            'alamat' => 'required|string|max:100',
            'phone' => 'required|numeric|digits_between:10,20',
        ]);

        // Menyimpan data customer ke tabel users
        $datauser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
            'status' => 'Active', // Set status default ke 'Active'
        ];

        User::create($datauser);

        return redirect(url('datacustomer'))->with('success', 'Customer berhasil ditambahkan.');
    }

    public function editdatacustomer($id)
    {
        $datacustomer = User::findOrFail($id);

        $param = [
            "modulname" => "editcustomer",
            "title" => "Edit Data Customer",
            "datacustomer" => $datacustomer
        ];

        return view('admin.formeditcustomer', $param);
    }

    public function saveeditdatacustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:30',
            'password' => 'nullable|string|min:8|confirmed', // Password boleh kosong saat edit
            'alamat' => 'required|string|max:100',
            'phone' => 'required|numeric|digits_between:10,20',
        ]);

        $user = User::findOrFail($id);

        $datauser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $datauser['password'] = Hash::make($request->input('password'));
        }

        User::where('id', $id)->update($datauser);

        return redirect(url('datacustomer'))->with('success', 'Customer berhasil diupdate.');
    }

    public function hapusdatacustomer(Request $request)
    {
        User::destroy($request->id);
        return redirect(url('datacustomer'))->with('success', 'Customer berhasil dihapus.');
    }

    public function block($id)
    {
        $data = ['status' => 'block'];
        User::where('id', $id)->update($data);
        return redirect(url('datacustomer'))->with('success', 'Customer berhasil diblokir.');
    }

    public function suspend($id)
    {
        $data = ['status' => 'suspend'];
        User::where('id', $id)->update($data);
        return redirect(url('datacustomer'))->with('success', 'Customer berhasil disuspend.');
    }

    public function activate($id)
    {
        $data = ['status' => 'active'];
        User::where('id', $id)->update($data);
        return redirect(url('datacustomer'))->with('success', 'Customer berhasil diaktifkan kembali.');
    }
}