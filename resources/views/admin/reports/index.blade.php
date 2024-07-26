@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>
    <form action="{{ route('reports.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" id="type" class="form-control">
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" name="year" id="year" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate</button>
    </form>

    @if(isset($orders))
    <h2>{{ ucfirst($type) }} Report for {{ $year }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Period</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->period }}</td>
                <td>{{ $order->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('reports.download-pdf', ['type' => $type, 'year' => $year]) }}" class="btn btn-success">Download PDF</a>
    @endif
</div>
@endsection
