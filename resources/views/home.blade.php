@extends('layouts.master')

@section('content')
<section id="home-section" class="hero">
    <!-- ... Your existing hero section code ... -->
</section>

<section class="ftco-section">
  <div class="col-md-12 text-center">
    <h2 class="mb-4">Categories</h2>
    <p class="lead">Explore various categories of networking devices to find the perfect fit for your needs.</p>
  </div>
  <div class="container">
    <div class="row no-gutters ftco-services">
      @foreach($categories as $category)
        <div class="col-12 col-md-3 text-center d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services mb-md-0 mb-4">
            <div class="icon d-flex justify-content-center align-items-center mb-2">
              <img src="{{ Storage::url($category->gambar) }}" alt="{{ $category->namacategory }}" class="img-fluid rounded-circle" style="max-width: 80%; height: auto; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            </div>
            <div class="media-body">
              <h3 class="heading">{{ $category->namacategory }}</h3>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12 text-center">
        <h2 class="mb-4">Products</h2>
        <p class="lead">Check out our latest products. We offer a range of high-quality items to suit your needs.</p>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach ($products as $product)
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="{{ url('products', $product->id) }}" class="img-prod position-relative product-img-wrapper">
              <img class="img-fluid" src="{{ Storage::url($product->gambar) }}" alt="{{ $product->namaproduct }}">
              <div class="overlay d-flex align-items-center justify-content-center">
                <span class="text-white"><i class="ion-ios-eye"></i> View</span>
              </div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="{{ url('/product', $product->id) }}" class="text-dark">{{ $product->namaproduct }}</a></h3>
              <div class="d-flex justify-content-center">
                <div class="pricing">
                  <p class="price mb-0"><span>Rp. {{ number_format($product->harga, 0, ',', '.') }}</span></p>
                </div>
              </div>
              <div class="bottom-area d-flex px-3 mt-3">
                <div class="m-auto d-flex">
                  <a href="{{ url('/userproduct/' . $product->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                    <span><i class="ion-ios-menu"></i></span>
                  </a>
                  <a href="/cart" class="buy-now d-flex justify-content-center align-items-center mx-1">
                    <span><i class="ion-ios-cart"></i></span>
                  </a>
                  <a href="/wishlist" class="heart d-flex justify-content-center align-items-center">
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

<section class="ftco-section testimony-section">
  <!-- ... Your existing testimony section code ... -->
</section>

<div>
  <div class="Our-Partner">  
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <h2 class="mb-4">OUR PARTNER</h2>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="{{ asset('resources/template_user/css/style.css') }}" />
  <div class="logos">
    <div class="logos-slide">
      <img src="{{ asset('resources/template_user/images/sct_cisco.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_dell.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_engenius.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_fiberhome.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_fujitsu.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_hikvision.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_hp.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_huawei.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_juniper.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_mikrotik.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_raisecom.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ruckus.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ruijie.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_sophos.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ubiquiti.jpg') }}" />
    </div>
    <div class="logos-slide">
      <img src="{{ asset('resources/template_user/images/sct_cisco.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_dell.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_engenius.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_fiberhome.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_fujitsu.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_hikvision.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_hp.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_huawei.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_juniper.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_mikrotik.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_raisecom.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ruckus.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ruijie.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_sophos.jpg') }}" />
      <img src="{{ asset('resources/template_user/images/sct_ubiquiti.jpg') }}" />
    </div>
  </div>
</div>
@endsection
