@extends('layouts.main')

@section('title', 'Data Category')

@section('content')
<div class="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white text-center">Data Category</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <h5 class="alert-heading"><i class="fas fa-check-circle"></i> Success</h5>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Nama Category</th>
                                        <th scope="col" class="text-center">Gambar</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listcategory as $key => $category)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $category->namacategory }}</td>
                                            <td class="text-center">
                                                @if ($category->gambar)
                                                    <img src="{{ Storage::url($category->gambar) }}" alt="{{ $category->namacategory }}" style="width: 100px; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ url('category/edit', $category->id) }}" class="btn btn-warning btn-sm mx-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ url('datacategory') }}" method="POST" class="d-inline" onsubmit="return confirm('Mau Menghapus Data?');">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $listcategory->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
