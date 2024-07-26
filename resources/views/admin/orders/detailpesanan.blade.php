@extends('layouts.main')

@section('title', 'Detail Pesanan')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white">Detail Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4 mt-4">
                            <div class="col-md-6">
                                <h5 class="card-title">Data Pembeli</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $pesanan->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telepon</th>
                                        <td>{{ $pesanan->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $pesanan->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Data Pesanan</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Tanggal Pesanan</th>
                                        <td>{{ $pesanan->tanggal_pesanan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pesanan</th>
                                        <td>{{ $pesanan->kodepesanan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge
                                                @if ($pesanan->status_pesanan == 'paid')
                                                    bg-warning
                                                @elseif ($pesanan->status_pesanan == 'confirmed')
                                                    bg-info
                                                @elseif ($pesanan->status_pesanan == 'packed')
                                                    bg-primary
                                                @elseif ($pesanan->status_pesanan == 'sent')
                                                    bg-success
                                                @else
                                                    bg-secondary
                                                @endif">
                                                {{ ucfirst($pesanan->status_pesanan) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Aksi</th>
                                        <td>
                                            @if ($pesanan->status_pesanan == 'pending')
                                            <form action="{{ route('orders.konfirmasi', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mt-3">Konfirmasi Pesanan</button>
                                            </form>
                                            @elseif ($pesanan->status_pesanan == 'dikonfirmasi')
                                            <form action="{{ route('orders.kemas', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning mt-3">Kemas Pesanan</button>
                                            </form>
                                            @elseif ($pesanan->status_pesanan == 'dikemas')
                                            <form action="{{ route('orders.kirim', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary mt-3">Kirim Pesanan</button>
                                            </form>
                                            @elseif ($pesanan->status_pesanan == 'dikirim')
                                            <form action="{{ route('orders.selesai', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mt-3">Selesaikan Pesanan</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="card-title">Data Produk</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <td>{{ $pesanan->namaproduct }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar</th>
                                        <td>
                                            <div class="text-center">
                                                <img src="{{ Storage::url($pesanan->gambar) }}" alt="Gambar Produk" class="img-fluid rounded" style="max-width: 80%; height: auto;">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>Rp{{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kuantitas</th>
                                        <td>{{ $pesanan->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Belanja</th>
                                        <td>Rp{{ number_format($pesanan->totalbelanja, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('datapesanan') }}" class="btn btn-primary mt-3">Kembali ke Daftar Pesanan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
