@extends('layouts.main')
@section('content')
<main class="cold-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        
    <div class="btn-toolbar mb-2 mb-md-0">
</div>
    </div>
    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $baris=1;
                @endphp
                @foreach ($listcustomer as $customer)
                <tr>
                    <th scope="row">{{$baris++}}</th>
                    <td>{{$customer->nama}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->no_telp}}</td>
                    <td>{{$customer->alamat}}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary btn-sm" href="{{url ('customer/detail') }}/{{ $customer["id"] }}"> Detail This Customer</a>
                        <a onclick="return confirm('Apakah yakin customer ini di blokir?')" class="btn btn-danger btn-sm" href="{{url('customer/activate') }}/{{ $customer["id"] }}"> Activate This Member</a>
                        </div>
                    </td>   
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {{ $listcustomer->links() }}
    </div>
</main>
@endsection