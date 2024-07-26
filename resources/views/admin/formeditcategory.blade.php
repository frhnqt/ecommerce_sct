@extends('layouts.main')

@section('title', 'Edit Data Category')

@section('content')
<div class="main-content">
    <div class="title">
        <h1>Edit Data Category</h1>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Error</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <h5 class="alert-heading"><i class="fas fa-check-circle"></i> Success</h5>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('category/update', $datacategory->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="namacategory">Nama Category</label>
                    <input type="text" class="form-control" id="namacategory" name="namacategory" value="{{ $datacategory->namacategory }}" required>
                    @error('namacategory')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
