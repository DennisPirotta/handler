@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <div class="container p-5 bg-dark justify-content-center text-center mb-4">
        <div class="d-flex justify-content-center">
            <button class="my-3 bg-darker position-relative border-0" style="width: 8rem;height: 8rem;border-radius: 4rem;cursor:pointer;" id="user-icon" data-mdb-toggle="modal" data-mdb-target="#icons">
                <img class="position-absolute top-50 start-50 translate-middle" width="64" src="{{ asset('/images/avatar/' . $user->avatar) }}" alt="Avatar">
                <i class="position-absolute top-50 start-50 translate-middle bi bi-pencil-fill display-4 text-black d-none"></i>
            </button>
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

    <div class="modal fade" id="icons" tabindex="-1" aria-labelledby="iconsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-darker">
                    <h5 class="modal-title text-white-50" id="iconsLabel">Cambia Icona</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('user.icon.update',$user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="btn-group row g-3 shadow-0">
                            @foreach(scandir('images/avatar') as $file)
                                @if(is_file('images/avatar/'.$file))
                                    <div class="col d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="icon" id="icon_{{ $file }}" value="{{$file}}" autocomplete="off" @if($user->avatar === $file) checked @endif />
                                        <label class="btn btn-dark mx-auto" for="icon_{{ $file }}"><img class="icon" src="{{ asset('images/avatar/'.$file) }}" alt="{{ $file }}" width="100"></label>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                    </div>
                    <div class="modal-footer border-darker">
                        <button type="submit" class="btn btn-dark bg-darker">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
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
            $('#user-icon').blur((e) => {
                $(e.target).find('img').css('filter','none')
                $(e.target).find('i').addClass('d-none')
            })
        })
    </script>
@endsection