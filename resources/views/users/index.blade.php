@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <div class="container p-5 bg-dark justify-content-center text-center mb-4">
        <div class="d-flex justify-content-center">
            <div class="my-3 bg-darker position-relative" style="width: 8rem;height: 8rem;border-radius: 4rem;cursor:pointer;" id="user-icon">
                <img class="position-absolute top-50 start-50 translate-middle" width="64" src="{{ asset('/images/icons/' . $user->avatar) }}" alt="Avatar">
                <i class="position-absolute top-50 start-50 translate-middle bi bi-pencil-fill display-4 text-black d-none"></i>
            </div>
        </div>

        <h2 class="text-white mb-4">{{ $user->name }}</h2>
        <div class="card text-start bg-darker mb-4">
            <ul class="list-group">
                <li class="list-group-item p-3 text-white bg-darker">
                    <span class="text-secondary">Ultimo Accesso</span>
                    <span class="float-end">{{ Carbon::parse($user->last_login_at)->diffForHumans() }}</span>
                </li>
                <li class="list-group-item p-3 text-white bg-darker">
                    <span class="text-secondary">Stato</span>
                    <span class="float-end text-white">
                        @if($user->isOnline())
                            Online &#128994;
                        @else
                            Offline &#128308;
                        @endif
                    </span>
                </li>
            </ul>
        </div>
        <form method="post" action="{{ route('logout') }}" class="d-none" id="logout-form"> @csrf </form>
        <button class="btn btn-dark bg-darker w-100 mb-2 p-3" onclick="$('#logout-form').submit()"><i class="bi bi-door-open"></i> Logout</button>
        <button class="btn btn-dark bg-darker w-100 mb-2 p-3" onclick="window.location.href = '{{ route('password.request') }}'"><i class="bi bi-key"></i> Cambia Password</button>
        <button class="btn btn-dark bg-darker w-100 mb-2 p-3"><i class="bi bi-key"></i> Modifica Account</button>
    </div>
    <script>
        $(()=>{
            $('#user-icon').hover((e)=>{
                $(e.target).find('img').css('filter','blur(2px)')
                $(e.target).find('i').removeClass('d-none')
            },(e) => {
                $(e.target).find('img').css('filter','none')
                $(e.target).find('i').addClass('d-none')
            })
        })
    </script>
@endsection