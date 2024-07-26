@extends('layouts.main')

@section('title', 'Input Data Customer')

@section('content')
<div class="main-content">
    <div class="title">
        Input Data Customer
        <form action="{{ url('customer/save') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Customer</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">No Telp</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection