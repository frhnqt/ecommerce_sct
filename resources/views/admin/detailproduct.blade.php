@extends('layouts.main')

@section('title', 'Detail Produk')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white text-center">
                        <h4 class="mb-0 text-white">Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kodeproduct">Kode Produk</label>
                                    <input type="text" class="form-control" id="kodeproduct" name="kodeproduct" value="{{ $product->kodeproduct }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="namaproduct">Nama Produk</label>
                                    <input type="text" class="form-control" id="namaproduct" name="namaproduct" value="{{ $product->namaproduct }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $product->stok }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="merk" name="merk" value="{{ $product->namamerk }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{ $product->namacategory }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{ number_format($product->harga, 0, ',', '.') }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="7" disabled>{{ $product->deskripsi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar Produk</label>
                                    <div class="text-center">
                                        <img src="{{ Storage::url($product->gambar) }}" alt="Gambar Produk" class="img-fluid rounded" style="max-width: 80%; height: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('dataproduct') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
