@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{asset('resources/template_user/vendor/chart.js/Chart.min.css')}}">
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Dashboard
    </div>

</div>
@endsection

@push('js')
<script src="{{asset('resources/template_user/vendor/chart.js/Chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('resources/template_user/assets/js/pages/index.min.js')}}"></script>
@endpush