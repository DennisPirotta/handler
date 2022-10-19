@extends('layouts.app')
@section('content')
    @vite(['resources/js/lottie-player.js','resources/js/lottie-web.js'])
    <x-welcome-animation :content="'home'"></x-welcome-animation>
    <div class="container position-absolute top-50 start-50 translate-middle d-none bg-dark rounded-5 p-5 text-center text-white animate__animated animate__fadeIn justify-content-center"
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
@endsection
