@extends('layouts.main')

@section('title', 'Pesanan Selesai')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Pesanan Selesai</h4>
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
                                        <th scope="col" class="text-center">Tanggal Pesanan</th>
                                        <th scope="col" class="text-center">Kode Pesanan</th>
                                        <th scope="col" class="text-center">Total Belanja</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listpesanandiselesaikan as $key => $pesanan)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $pesanan->tanggal_pesanan }}</td>
                                        <td class="text-center">{{ $pesanan->kodepesanan }}</td>
                                        <td class="text-center">{{ number_format($pesanan->totalbelanja, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ ucfirst($pesanan->status_pesanan) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('pesanan/' . $pesanan->id) }}" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
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
