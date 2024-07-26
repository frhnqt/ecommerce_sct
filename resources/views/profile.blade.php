@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="/profile" class="list-group-item list-group-item-action active">Account Settings</a>
                <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">Orders</a>
                <a href="#" class="list-group-item list-group-item-action">Settings</a>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Account Settings</h4>
                </div>
                <div class="card-body">
                    <!-- Personal Information -->
                    <h5>Personal Information</h5>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Nomor Handphone</label>
                            <input type="text" class="form-control" id="phone_number" value="{{ Auth::user()->phone_number }}" readonly>
                        </div>
                        
                        
                        <!-- Add more fields as necessary -->
                    </form>

                    <hr>

                    <!-- Payment Status -->
                    

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
