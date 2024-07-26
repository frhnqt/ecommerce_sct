@extends('layouts.main')

@section('title', 'Data Produk')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Data Produk</h4>
                    </div>
                    <div class="card-body">
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
                                        <th scope="col" class="text-center">Kode Produk</th>
                                        <th scope="col" class="text-center">Nama Produk</th>
                                        <th scope="col" class="text-center">Stok</th>
                                        <th scope="col" class="text-center">Merk</th>
                                        <th scope="col" class="text-center">Category</th>
                                        <th scope="col" class="text-center">Harga</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listproduct as $key => $product)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $product->kodeproduct }}</td>
                                            <td class="text-center">{{ $product->namaproduct }}</td>
                                            <td class="text-center">{{ $product->stok }}</td>
                                            <td class="text-center">{{ $product->namamerk }}</td>
                                            <td class="text-center">{{ $product->namacategory }}</td>
                                            <td class="text-center">{{ number_format($product->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ url('product/' . $product->id) }}"
                                                        class="btn btn-info btn-sm" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ url('product/edit/' . $product->id) }}"
                                                        class="btn btn-warning btn-sm mx-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ url('product/delete') }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $listproduct->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
