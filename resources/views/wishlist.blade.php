@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Your Wishlist</h1>
    @if($wishlists->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $wishlist)
                <tr>
                    <td>{{ $wishlist->product->namaproduct }}</td>
                    <td class="image-prod">
                        <div class="img" style="background-image:url({{ asset('images/' . $wishlist->product->gambar) }});"></div>
                    </td>
                    <td class="product-name">
                        <p>{{ $wishlist->product->deskripsi }}</p>
                    </td>
                    <td class="price">Rp. {{ number_format($wishlist->product->harga, 0, ',', '.') }}</td>
                    <td class="actions">
                        <!-- View Product Button -->
                        <a href="{{ route('product.show', $wishlist->product->id) }}" class="btn btn-primary btn-sm">View Product</a>
                        
                        <!-- Add to Cart Button -->
                        <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                        </form>

                        <!-- Remove from Wishlist Button -->
                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
