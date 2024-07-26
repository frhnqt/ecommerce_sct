@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
<div class="main-content">
    <div class="card">
        <div class="card-header text-center">
            <h2>Laporan Bulanan dan Tahunan</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Bulanan</th>
                            <th>Tahunan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data laporan akan diisi di sini -->
                        @foreach ($cetaklaporan as $report => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->bulanan }}</td>
                                <td>{{ $data->tahunan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
