@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if($cart->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td class="image-prod">
                        <!-- Ensure that the image path is correct and image exists -->
                        <div class="img" style="background-image:url('{{ Storage::url($item->gambar) }}'); background-size: cover; background-position: center; width: 100px; height: 100px;"></div>
                    </td>
                    <td class="product-name">
                        <h3>{{ $item->namaproduct }}</h3>
                        <p>{{ $item->deskripsi }}</p>
                    </td>
                    <td class="price">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="quantity">
                        <div class="d-flex align-items-center">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 80px;">
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                            </form>
                        </div>
                    </td>
                    <td class="total-price">
                        Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                    </td>
                    <td class="actions">
                        <!-- Remove Button with Trash Icon -->
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> <!-- Font Awesome Trash Icon -->
                            </button>
                        </form>
                        <!-- Proceed to Checkout Button with Checkout Icon -->
                        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-sm ml-2">
                            <i class="fas fa-credit-card"></i> <!-- Font Awesome Credit Card Icon -->
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
