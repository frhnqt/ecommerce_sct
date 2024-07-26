@extends('layouts.master')

@section('content')
<div class="container my-5">
    <!-- Thank You Message -->
    <div class="text-center mb-4">
        <h1 class="display-4 text-success">Thank You for Your Purchase!</h1>
        <p class="lead">Your order has been successfully.</p>
        <div class="alert alert-success">
            <h4 class="alert-heading">Order Code:</h4>
            <p class="mb-0 font-weight-bold">{{ $checkout->kodepesanan }}</p>
        </div>
    </div>

    <!-- Order Summary Card -->
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $checkout->name }}</p>
                    <p><strong>Address:</strong> {{ $checkout->address }}</p>
                    <p><strong>Phone:</strong> {{ $checkout->no_telp }}</p>
                    <p><strong>Email:</strong> {{ $checkout->email }}</p>
                </div>

                <!-- Footer with Financial Summary -->
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Subtotal:</strong> Rp. {{ number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-6 text-right">
                            <p><strong>Delivery Fee:</strong> Rp. {{ number_format($deliveryFee, 0, ',', '.') }}</p>
                            <p><strong>Discount:</strong> Rp. {{ number_format($discount, 0, ',', '.') }}</p>
                            <p class="font-weight-bold"><strong>Total Amount:</strong> Rp. {{ number_format($totalbelanja, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
