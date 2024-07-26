@extends('layouts.master')

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{ Storage::url($product->gambar) }}" class="image-popup">
                    <img src="{{ Storage::url($product->gambar) }}" class="img-fluid" alt="{{ $product->namaproduct }}">
                </a>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $product->namaproduct }}</h3>

                <!-- Rating Section -->
                <div class="rating d-flex mb-3">
                    <!-- Add your rating HTML here -->
                </div>

                <p class="price"><span>Rp. {{ number_format($product->harga, 2, ',', '.') }}</span></p>
                <p><strong>Stok:</strong> {{ $product->stok }}</p>
                <p><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>

                <!-- Add to Cart and Wishlist Buttons -->
                <div class="d-flex align-items-center mt-3">
                    <form action="{{ url('/cart/save') }}" method="POST" class="d-flex align-items-center mr-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="productPrice" value="{{ $product->harga }}">
                        <div class="form-group d-flex align-items-center mr-2">
                            <label for="quantity" class="mr-2">Qty:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control-sm" style="width: 70px;" oninput="updateTotal()">
                        </div>
                        <p id="totalbelanja" class="mr-3">Total: Rp. {{ number_format($product->harga, 2, ',', '.') }}</p>
                        <button type="submit" class="btn btn-icon btn-black">
                            <i class="ion-ios-cart"></i>
                        </button>
                    </form>

                    <form action="{{ url('/wishlist/save') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-icon btn-outline-black">
                            <i class="ion-ios-heart"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <!-- Related Products Heading -->
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Related Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>

        <!-- Related Products List -->
        <div class="row">
            <div class="col-md-6 col-lg-3 ftco-animate">
                <!-- Product 1 -->
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <!-- Product 2 -->
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <!-- Product 3 -->
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <!-- Product 4 -->
            </div>
        </div>
    </div>
</section>

<script>
    function updateTotal() {
        // Retrieve and parse the price value
        var priceElement = document.getElementById('productPrice');
        var price = parseFloat(priceElement.value.replace(',', '.'));

        // Retrieve and parse the quantity value
        var quantityElement = document.getElementById('quantity');
        var quantity = parseFloat(quantityElement.value);

        // Ensure that both values are numbers
        if (isNaN(price) || isNaN(quantity)) {
            console.error('Invalid price or quantity.');
            return;
        }

        // Calculate total
        var totalbelanja = price * quantity;

        // Update the total price display
        document.getElementById('totalbelanja').innerText = 'Total: Rp. ' + totalbelanja.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    }

    // Initialize the total on page load
    updateTotal();
</script>

@endsection
