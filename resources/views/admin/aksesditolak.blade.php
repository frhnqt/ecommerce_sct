<!DOCTYPE html>
<html>
<head>
    <title>Akses Ditolak</title>
    <link rel="stylesheet" href="{{ asset('resources/template_admin/css/aksesditolak.css') }}">
</head>
<body>
<div class="wrapper">
        <!-- untuk home -->
        <section id="home">
            <img src="{{ asset('resources/template_admin/img/Orang-Bingung1.png')}}">
            <div class="kolom">
                <p class="deskripsi">Oops...</p>
                <h2>Akses Ditolak</h2>
                <p>Anda tidak memiliki hak untuk mengakses halaman ini.</p>
                <p><a href="{{ route('home') }}" class="tbl-pink">Kembali ke Beranda</a></p>
            </div>
        </section>
</body>
</html>
