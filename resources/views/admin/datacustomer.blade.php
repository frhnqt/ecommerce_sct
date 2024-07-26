@extends('layouts.main')

@section('title', 'Data Customer')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Data Customer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan sukses -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                <h5 class="alert-heading"><i class="fas fa-check-circle"></i> Success</h5>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Nama Customer</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">No Telp</th>
                                        <th scope="col" class="text-center">Alamat</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listcustomer as $key => $customer)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $customer->name }}</td>
                                            <td class="text-center">{{ $customer->email }}</td>
                                            <td class="text-center">{{ $customer->phone }}</td>
                                            <td class="text-center">{{ $customer->alamat }}</td>
                                            <td class="text-center">{{ $customer->status }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ url('customer/edit', $customer->id) }}" class="btn btn-warning btn-sm mx-1" title="Edit">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>

                                                    <form action="{{ url('datacustomer') }}" method="POST" class="d-inline" onsubmit="return confirm('Mau Menghapus Data?')">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $customer->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm mx-1" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ url('customer/block', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mau memblokir Data?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark btn-sm mx-1" title="Blockir">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ url('customer/suspend', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mau suspend Data?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary btn-sm mx-1" title="Suspend">
                                                            <i class="fas fa-user-slash"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ url('customer/activate', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mau mengaktifkan kembali data customer?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mx-1" title="Reactivate">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $listcustomer->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
