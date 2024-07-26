@extends('layouts.main')

@section('title', 'Input Data Merk')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">Input Data Merk</h4>
                    </div>
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

                        <form action="{{ url('merk/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="namamerk">Nama Merk</label>
                                <input type="text" class="form-control" id="namamerk" name="namamerk" required>
                                @error('namamerk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
