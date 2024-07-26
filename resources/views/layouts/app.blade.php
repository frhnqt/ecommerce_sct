<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background: linear-gradient(135deg, #16CF91, #9b59b6);
            font-family: 'Roboto', sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #9b59b6;
            /* Warna latar belakang header */
            color: white;
            /* Warna teks header */
            border-radius: 15px 15px 0 0;
        }

        .btn-primary {
            background: #9b59b6;
            border: none;
        }

        .btn-outline-primary {
            border: 2px solid #9b59b6;
            color: #9b59b6;
        }

        .btn-outline-primary:hover {
            background: #9b59b6;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>