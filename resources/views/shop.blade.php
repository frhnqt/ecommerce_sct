@extends('layouts.master')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('resources/template_user/images/bg-shop.jpg')">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="/">Home</a></span>
          <span>Products</span>
        </p>
        <h1 class="mb-0 bread">Products</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 mb-5 text-center">
        <div class="category-scroll">
          <ul class="product-category d-flex justify-content-center">
            @foreach($categories as $category)
              <li class="mr-4">
                <a href="{{ url('/products?category=' . $category->id) }}" class="{{ request('category') == $category->id ? 'active' : '' }}">
                  {{ $category->namacategory }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach ($products as $product)
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="{{ url('/product/' . $product->id) }}" class="img-prod">
              <img class="img-fluid" src="{{ Storage::url($product->gambar) }}" alt="{{ $product->namaproduct }}">
              <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="{{ url('/product/' . $product->id) }}">{{ $product->namaproduct }}</a></h3>
              <div class="d-flex justify-content-center">
                <div class="pricing">
                  <p class="price"><span>Rp. {{ number_format($product->harga, 0, ',', '.') }}</span></p>
                </div>
              </div>
              <div class="bottom-area d-flex justify-content-center px-3">
                <div class="m-auto d-flex">
                  <a href="{{ url('/userproduct/' . $product->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                    <span><i class="ion-ios-menu"></i></span>
                  </a>
                  <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                    <span><i class="ion-ios-cart"></i></span>
                  </a>
                  <a href="#" class="heart d-flex justify-content-center align-items-center">
                    <span><i class="ion-ios-heart"></i></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

    <!-- Pagination -->
    <div class="row mt-5">
      <div class="col text-center">
        <div class="block-27">
          <ul class="pagination justify-content-center">
            <li class="page-item previous-page">
              <a class="link-page" href="#">&lt;</a>
            </li>
            <li class="page-item current-page active">
              <a>1</a>
            </li>
            <li class="page-item current-page">
              <a class="link-page" href="#">2</a>
            </li>
            <li class="page-item current-page">
              <a class="link-page" href="#">3</a>
            </li>
            <li class="page-item current-page">
              <a class="link-page" href="#">4</a>
            </li>
            <li class="page-item dots">
              <a class="link-page" href="#">...</a>
            </li>
            <li class="page-item current-page">
              <a class="link-page" href="#">10</a>
            </li>
            <li class="page-item next-page">
              <a class="link-page" href="#">&gt;</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
