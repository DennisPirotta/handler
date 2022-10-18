<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">

<div id="app">
    <main class="py-4">
        <x-welcome-animation :content="'home'"></x-welcome-animation>
        <div class="container position-absolute top-50 start-50 translate-middle d-none shadow-sm bg-dark rounded-5 p-5 text-center text-white animate__animated animate__fadeIn justify-content-center"
             id="home">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <lottie-player src="{{ asset('images/lottie/management.json') }}" background="transparent"
                                   autoplay loop></lottie-player>
                </div>
                <div class="col-12 col-md-6">
                    <span class="h1">Handler</span>
                    <p class="mt-3 h5 text-secondary">Gestisci facilmente i tuoi movimenti e monitora la disponibilità</p>
                    <a href="{{ route('home') }}">
                        <button type="button" class="btn btn-primary btn-rounded mt-3">Entra</button>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>