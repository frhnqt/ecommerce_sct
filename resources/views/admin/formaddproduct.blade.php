@extends('layouts.main')

@section('title', 'Input Data Product')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white">Input Data Produk</h4>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                <h5 class="alert-heading"><i class="fas fa-check-circle"></i> Success</h5>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ url('product/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="kodeproduct">Kode Produk</label>
                                <input type="text" class="form-control" id="kodeproduct" name="kodeproduct"
                                    value="{{ old('kodeproduct') }}" required>
                                @error('kodeproduct')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="namaproduct">Nama Produk</label>
                                <input type="text" class="form-control" id="namaproduct" name="namaproduct"
                                    value="{{ old('namaproduct') }}" required>
                                @error('namaproduct')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    value="{{ old('stok') }}" required>
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <select class="form-control" id="merk" name="merk" required>
                                    <option value="">Pilih Merk</option>
                                    @foreach ($listmerk as $key => $merk)
                                        <option value="{{ $key }}">{{ $merk }}</option>
                                    @endforeach
                                </select>
                                @error('merk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($listcategory as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="{{ old('harga') }}" required>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"
                                    rows="3" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Produk</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                                @error('gambar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
