@extends('layouts.main')

@section('title', 'Edit Data Merk')

@section('content')
<div class="main-content">
    <div class="title">
        <h1>Edit Data Merk</h1>
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

            <form action="{{ url('merk/update', $datamerk->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="namamerk">Nama Merk</label>
                    <input type="text" class="form-control" id="namamerk" name="namamerk" value="{{ $datamerk->namamerk }}"
                        required>
                    @error('namamerk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection