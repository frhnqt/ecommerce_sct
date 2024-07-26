@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="/profile" class="list-group-item list-group-item-action">Account Settings</a>
                <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action active">Orders</a>
                <a href="#" class="list-group-item list-group-item-action">Settings</a>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Pesanan</th>
                                    <th scope="col">Kode Pesanan</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Total Belanja</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->tanggal_pesanan }}</td>
                                    <td>{{ $order->kodepesanan }}</td>
                                    <td>{{ $order->invoice }}</td>
                                    <td>{{ $order->metodepembayaranid }}</td>
                                    <td>{{ $order->totalbelanja }}</td>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
