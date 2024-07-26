@extends('layouts.main')

@section('title', 'Input Data admin')

@section('content')
<div class="main-content">
    <div class="title">
        Input Data admin
        <form action="{{ url('admin/save') }}" method="POST">
            @csrf
            <div class="form-group">
    <label for="name">Nama admin</label>
    <input type="text" class="form-control" id="name" name="name" required>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="password-confirm">Confirm Password</label>
    
    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
</div>


<div class="form-group">
    <label for="phone">Nomor Telepon</label>
    <input type="text" class="form-control" id="phone" name="phone" required>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat">
</div>

<div class="form-group">
    <label for="role_id">Role ID</label>
    <input type="text" class="form-control" id="role_id" name="role_id" value="2">
</div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection