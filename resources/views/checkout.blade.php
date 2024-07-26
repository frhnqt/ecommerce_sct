@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Checkout</h1>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form id="payment-form" action="{{ route('checkout.store') }}" method="post" class="billing-form">
                    @csrf
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="form-group">
                        <label>
                            <input type="radio" name="billing_option" value="database" onclick="fillFromDatabase()"> Use Billing Details from Account
                        </label>
                        <label>
                            <input type="radio" name="billing_option" value="manual" onclick="fillManually()"> Enter Billing Details Manually
                        </label>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="streetaddress">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="House number, street name, city, country" />
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="no_telp" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailaddress">Email Address</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <!-- Add your payment methods here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total" value="{{ $total }}">
                </form>
                <button id="pay-button" class="btn btn-primary py-3 px-4">Place an order</button>
            </div>
            <div class="col-xl-12">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span class="all-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </p>
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span class="delivery-fee">Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                            </p>
                            <p class="d-flex">
                                <span>Discount</span>
                                <span class="promo">Rp {{ number_format($discount, 0, ',', '.') }}</span>
                            </p>
                            <hr />
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span class="final-price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        document.getElementById('payment-form').submit();
    };

    function fillFromDatabase() {
        var userData = {
            name: "{{ auth()->user()->name }}",
            address: "{{ auth()->user()->address }}",
            phone: "{{ auth()->user()->no_telp }}",
            email: "{{ auth()->user()->email }}"
        };

        document.getElementById('name').value = userData.name;
        document.getElementById('address').value = userData.address;
        document.getElementById('phone').value = userData.phone;
        document.getElementById('email').value = userData.email;
    }

    function fillManually() {
        document.getElementById('name').value = '';
        document.getElementById('address').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('email').value = '';
    }
</script>
@endsection
