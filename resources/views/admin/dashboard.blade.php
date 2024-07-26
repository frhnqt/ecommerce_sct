@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="{{asset('resources/template_admin/vendor/chart.js/Chart.min.css')}}">
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Dashboard
    </div>

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Monthly Sales</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyOrdersChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat">
                            <h3>Total Pesanan Bulan Ini</h3>
                            <p>{{ $totalMonthlyOrders }}</p>
                        </div>
                        <div class="stat">
                            <h3>Total Pesanan Tahun Ini</h3>
                            <p>{{ $totalYearlyOrders }}</p>
                        </div>
                        <div class="stat">
                            <h3>Total Pesanan</h3>
                            <p>{{ $totalOrders }}</p>
                        </div>
                        <div class="stat">
                            <h3>Total Penjualan</h3>
                            <p>Rp{{ number_format($totalSales, 0, ',', '.') }}</p>
                        </div>
                        <div class="stat">
                            <h3>Total Penjualan Bulan Ini</h3>
                            <p>Rp{{ number_format($monthlySales, 0, ',', '.') }}</p>
                        </div>
                        <div class="stat">
                            <h3>Total Penjualan Tahun Ini</h3>
                            <p>Rp{{ number_format($yearlySales, 0, ',', '.') }}</p>
                        </div>
                        <canvas id="yearlyOrdersChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('resources/template_admin/vendor/chart.js/Chart.min.js')}}"></script>
@endpush
