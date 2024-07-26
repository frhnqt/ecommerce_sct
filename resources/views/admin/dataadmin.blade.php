@extends('layouts.main')

@section('content')
<div class="main-content">
  <!-- Menampilkan pesan flash error jika ada -->
  @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <!-- Menampilkan pesan flash sukses jika ada -->
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="title mb-3">
    <h2>Data Admin</h2>
  </div>
  
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Admin</th>
        <th scope="col">Email</th>
        <th scope="col">Nomor Telepon</th>
        <th scope="col">Alamat</th>
        <th scope="col">Role ID</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @php
        $baris = 1;
      @endphp
      @foreach($listadmin as $admin)
        <tr>
          <th scope="row">{{ $baris }}</th>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ $admin->phone }}</td>
          <td>{{ $admin->alamat }}</td>
          <td>{{ $admin->role_id }}</td>
          <td class="text-center">
            <a href="{{ url('admin/edit', $admin->id) }}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i>
            </a>
            <form onsubmit="return confirm('Mau Menghapus Data?');" action="{{ url('dataadmin') }}" method="post" style="display:inline;">
              @method('delete')
              @csrf
              <input type="hidden" name="id" value="{{ $admin->id }}">
              <button class="btn btn-sm btn-danger" type="submit">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @php
          $baris++;
        @endphp
      @endforeach
    </tbody>
  </table>
  {{$listadmin->links()}}
</div>
@endsection