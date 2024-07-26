<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JujungShop &mdash; Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('resources/template_admin/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/template_admin/vendor/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('resources/template_admin/vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">


    @stack('css')

    <link rel="stylesheet" href="{{asset('resources/template_admin/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/template_admin/assets/css/bootstrap-override.min.css')}}">
    <link rel="stylesheet" id="theme-color" href="{{asset('resources/template_admin/assets/css/dark.min.css')}}">
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        @include('layouts.header')
        @include('layouts.nav_admin')        

        @yield('content')

        @include('layouts.settings')

        <footer>
            Copyright © 2024 Surya Citra Teknologi </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="{{asset('resources/template_admin/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('resources/template_admin/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <!-- js for this page only -->
    @stack('js')
    <!-- ======= -->
    <script src="{{asset('resources/template_admin/assets/js/main.min.js')}}"></script>
    <script>
        Main.init()
    </script>
</body>

</html>