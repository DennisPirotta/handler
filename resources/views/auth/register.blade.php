@extends('layouts.app')

@section('content')
    <div class="container shadow-sm bg-dark rounded-5 p-3 text-center text-white animate__animated animate__fadeIn justify-content-center">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <lottie-player src="{{ asset('images/lottie/register.json') }}"  background="transparent"  speed="1"   loop autoplay></lottie-player>
            </div>
            <div class="col-12 col-md-6">
                <form class="w-75 mx-auto mt-n4" autocomplete="off" id="register-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name input -->
                    <div class="form-outline form-white mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                        <label class="form-label" for="name">Name</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline form-white mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <label class="form-label text-white" for="password">Password</label>
                    </div>

                    <!-- Confirm Password input -->
                    <div class="form-outline form-white mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <label class="form-label text-white" for="password-confirm">Confirm Password</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline form-white mb-3">
                        <input id="key" type="password" class="form-control @error('key') is-invalid @enderror" name="key" required autocomplete="new-password">
                        <label class="form-label text-white" for="password">Key</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>

                    <!-- Register buttons -->
                    <small class="text-center">
                        <p>Already a member? <a href="{{ route('login') }}">Login</a></p>
                    </small>
                </form>
            </div>
        </div>

    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>
        $(()=>{
            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                new mdb.Input(formOutline).update();
            });
        })
    </script>
@endsection
