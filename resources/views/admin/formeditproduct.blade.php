@extends('layouts.main')

@section('title', 'Edit Data Product')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0 text-white">Edit Data Produk</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Error</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('product/update', $dataproduct->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="kodeproduct">Kode Produk</label>
                                        <input type="text" class="form-control" id="kodeproduct" name="kodeproduct"
                                            value="{{ $dataproduct->kodeproduct }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="namaproduct">Nama Produk</label>
                                        <input type="text" class="form-control" id="namaproduct" name="namaproduct"
                                            value="{{ $dataproduct->namaproduct }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="stok">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok"
                                            value="{{ $dataproduct->stok }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="merk">Merk</label>
                                        <select class="form-control" id="merk" name="merk" required>
                                            @foreach ($listmerk as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $key == $dataproduct->merkid ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="category">Kategori</label>
                                        <select class="form-control" id="category" name="category" required>
                                            @foreach ($listcategory as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $key == $dataproduct->categoryid ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            value="{{ $dataproduct->harga}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                            required>{{ $dataproduct->deskripsi }}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="gambar">Gambar Produk</label><br>
                                        <img src="{{Storage::url($dataproduct->gambar)}}" alt="Product Image"
                                            style="max-width: 200px; height: auto; float: left; margin-right: 10px;">
                                        <input type="file" class="form-control-file mt-2" id="gambar" name="gambar">
                                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                            gambar.</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning text-white btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection