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

    <!-- Scripts -->
    @vite(['resources/js/app.js','resources/js/mdb.js','resources/js/addon.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

{{--    <script>--}}
{{--        // Check that service workers are registered--}}
{{--        if ('serviceWorker' in navigator) {--}}
{{--            // Use the window load event to keep the page load performant--}}
{{--            window.addEventListener('load', () => {--}}
{{--                navigator.serviceWorker.register('/sw.js');--}}
{{--            });--}}
{{--        }--}}

{{--        let deferredPrompt;--}}

{{--        window.addEventListener('beforeinstallprompt', (e) => {--}}
{{--            e.preventDefault();--}}
{{--            deferredPrompt = e;--}}
{{--        });--}}
{{--    </script>--}}

    <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>
<body class="bg-dark">
@if(url()->current() !== route('login') && url()->current() !== route('register') && url()->current() !== route('welcome'))
    <x-navbar></x-navbar>
@endif
@yield('content')
</body>
</html>
