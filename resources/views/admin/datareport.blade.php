@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Laporan</h4>
                        <a href="{{ url('cetaklaporan') }}?export=pdf" class="btn btn-sm btn-warning"> Export PDF </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Tanggal Pesanan</th>
                                        <th scope="col" class="text-center">Kode Pesanan</th>
                                        <th scope="col" class="text-center">Invoice</th>
                                        <th scope="col" class="text-center">Metode Pembayaran</th>
                                        <th scope="col" class="text-center">Total Belanja</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listpesanandiselesaikan as $key => $pesanan)
                                    <tr>
                                        <td scope="col" class="text-center">{{ $key + 1 }}</td>
                                        <td scope="col" class="text-center">{{ $pesanan->tanggal_pesanan }}</td>
                                        <td scope="col" class="text-center">{{ $pesanan->kodepesanan }}</td>
                                        <td scope="col" class="text-center">{{ $pesanan->invoice }}</td>
                                        <td scope="col" class="text-center">{{ $pesanan->metodepembayaran ? $pesanan->metodepembayaran->namabank : 'N/A' }}</td>
                                        <td scope="col" class="text-center">{{ number_format($pesanan->totalbelanja, 0, ',', '.') }}</td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $listpesanandiselesaikan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
