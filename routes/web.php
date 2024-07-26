<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CekoutController;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User_HomeController;
use App\Http\Controllers\Admin_HomeController;


//USER & ADMIN
Route::get('/', [User_HomeController::class, 'indexuser']);

//ROUTE LOGIN
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//USER HOME
Route::get('/home', [User_HomeController::class, 'indexuser'])->name('home');
Route::get('/checkout', [PesananController::class, 'indexcekout'])->name('checkout.index');
Route::get('wishlist', [WishlistController::class, 'indexwishlist'])->name('wishlist.index');
Route::get('/products', [ProductController::class, 'indexproduct'])->name('products.index');
Route::get('/userproduct/{id}', [ProductController::class, 'detailproductuser'])->name('product.detail');
Route::get('/shop', [ProductController::class, 'indexshop'])->name('shop.index');
Route::get('/cart', [PesananController::class, 'indexcart'])->name('cart.index');
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::middleware(['auth'])->group(function () {
    //CEKOUT
    Route::post('/checkout/save', [PesananController::class, 'storecekout'])->name('checkout.store');
    Route::get('/checkout/success', [PesananController::class, 'success'])->name('checkout.success');
    Route::get('/orders', [PesananController::class, 'indexorder'])->name('orders.index');
    //WISHLIST
    Route::post('/wishlist/save', [WishlistController::class, 'storewishlist'])->name('wishlist.store');
    Route::delete('wishlist/{id}', [WishlistController::class, 'destroywishlist'])->name('wishlist.destroy');
    //CART
    Route::post('/cart/save', [PesananController::class, 'storecart'])->name('cart.store');
    Route::patch('cart/{id}', [PesananController::class, 'updatecart'])->name('cart.update');
    Route::delete('cart/{id}', [PesananController::class, 'destroycart'])->name('cart.destroy');
});

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

//ADMIN 
route::middleware(['auth'])->group(function () {
    // Rute untuk halaman utama yang mengarah ke tampilan dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // Rute untuk halaman utama
    Route::get('/admin/home', [Admin_HomeController::class, 'indexadmin'])->name('home');

    //ROUTE DATA ADMIN (ADMIN)
    Route::get('dataadmin', [AdminController::class, 'indexdataadmin']);
    Route::get('/admin/add', [AdminController::class, 'addadmin'])->name('addadmin');
    Route::post('/admin/save', [AdminController::class, 'savedataadmin'])->name('savedataadmin');
    Route::get('/admin/edit/{id}', [AdminController::class, 'editdataadmin'])->name('editdataadmin');
    Route::post('/admin/update/{id}', [AdminController::class, 'saveeditdataadmin'])->name('saveeditdataadmin');
    Route::delete('dataadmin', [AdminController::class, 'hapusdataadmin']);
    Route::post('/admin/saveuser', [AdminController::class, 'saveuser'])->name('admin.saveuser');

    //ROUTE DATA CUSTOMER (ADMIN)
    Route::get('datacustomer', [CustomerController::class, 'indexdatacustomer']);
    Route::get('/customer/add', [CustomerController::class, 'addcustomer'])->name('addcustomer');
    Route::post('/customer/save', [CustomerController::class, 'savedatacustomer'])->name('savedatacustomer');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'editdatacustomer'])->name('editdatacustomer');
    Route::post('/customer/update/{id}', [CustomerController::class, 'saveeditdatacustomer'])->name('saveeditdatacustomer');
    Route::delete('datacustomer', [CustomerController::class, 'hapusdatacustomer']);
    Route::get('customer/block/{id}', [CustomerController::class, 'block']);
    Route::get('customer/suspend/{id}', [CustomerController::class, 'suspend']);

    //ROUTE DATA PRODUCT (ADMIN)
    Route::get('dataproduct', [ProductController::class, 'indexdataproduct'])->name('products.index');
    Route::get('product/add', [ProductController::class, 'adminaddproduct'])->name('products.add');
    Route::post('product/save', [ProductController::class, 'savedataproduct'])->name('products.save');
    Route::get('product/{id}', [ProductController::class, 'adminshowdataproduct'])->name('products.show');
    Route::get('product/edit/{id}', [ProductController::class, 'editdataproduct'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'saveeditdataproduct'])->name('product.update');
    Route::post('product/delete', [ProductController::class, 'hapusdataproduct'])->name('products.delete');

    //ROUTE DATA MERK (ADMIN)
    Route::get('datamerk', [MerkController::class, 'indexdatamerk']);
    Route::get('/merk/add', [MerkController::class, 'addmerk'])->name('addmerk');
    Route::post('/merk/save', [MerkController::class, 'savedatamerk'])->name('savedatamerk');
    Route::get('/merk/edit/{id}', [MerkController::class, 'editdatamerk'])->name('editdatamerk');
    Route::post('/merk/update/{id}', [MerkController::class, 'saveeditdatamerk'])->name('saveeditdatamerk');
    Route::delete('datamerk', [MerkController::class, 'hapusdatamerk']);

    //ROUTE DATA CATEGORY (ADMIN)
    Route::get('datacategory', [CategoryController::class, 'indexdatacategory']);
    Route::get('/category/add', [CategoryController::class, 'addcategory'])->name('addcategory');
    Route::post('/category/save', [CategoryController::class, 'savedatacategory'])->name('savedatacategory');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editdatacategory'])->name('editdatacategory');
    Route::post('/category/update/{id}', [CategoryController::class, 'saveeditdatacategory'])->name('saveeditdatacategory');
    Route::delete('datacategory', [CategoryController::class, 'hapusdatacategory']);

    //ROUTE DATA PESANAN (ADMIN)
    Route::get('datapesanan', [PesananController::class, 'indexdatapesanan'])->name('orders.datapesananmasuk');
    Route::get('pesanan/add', [PesananController::class, 'addpesanan'])->name('orders.formaddpesanan');
    Route::post('pesanan/save', [PesananController::class, 'savedatapesanan'])->name('orders.save');
    Route::post('pesanan/delete', [PesananController::class, 'hapusdatapesanan'])->name('orders.delete');
    Route::get('pesanan/{id}', [PesananController::class, 'showpesanan'])->name('orders.show');
    Route::post('/pesanan/konfirmasi/{id}', [PesananController::class, 'konfirmasi'])->name('orders.konfirmasi');
    Route::get('datapesanandikonfirmasi', [PesananController::class, 'dikonfirmasi'])->name('orders.dikonfirmasi');
    Route::post('/pesanan/{id}/kemas', [PesananController::class, 'kemas'])->name('orders.kemas');
    Route::get('/datapesanandikemas', [PesananController::class, 'indexDikemas'])->name('orders.dikemas');
    Route::get('/datapesanandikirim', [PesananController::class, 'indexDikirim'])->name('orders.dikirim');
    Route::post('/pesanan/{id}/kirim', [PesananController::class, 'kirim'])->name('orders.kirim');
    Route::get('/datapesananselesai', [PesananController::class, 'indexSelesai'])->name('orders.selesai');
    Route::post('/pesanan/{id}/selesai', [PesananController::class, 'selesai'])->name('orders.selesai');
    Route::get('/admin/dashboard', [PesananController::class, 'dashboard'])->name('admin.dashboard');


    //ROUTE DATA REPORT (ADMIN)
    Route::get('/datareport', [ReportController::class, 'indexlaporan'])->name('datareport');
    Route::get('/cetaklaporan', [ReportController::class, 'cetaklaporan'])->name('cetaklaporan');
});
