@extends('layouts.main')

@section('title', 'Edit Data Customer')

@section('content')
<div class="main-content">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Data Customer</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('customer/update', $datacustomer->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $datacustomer->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $datacustomer->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">No Telp</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $datacustomer->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $datacustomer->alamat }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection