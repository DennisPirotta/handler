@extends('layouts.app')

@section('content')
    <div class="container shadow-sm bg-dark rounded-5 p-3 mt-n3 text-center text-white animate__animated animate__fadeIn justify-content-center">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <lottie-player src="{{ asset('images/lottie/login.json') }}"  background="transparent"  speed="1"   loop autoplay></lottie-player>
            </div>
            <div class="col-12 col-md-6">
                <form class="w-75 mx-auto" autocomplete="off" id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline form-white mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="username">
                        <label class="form-label" for="name">Name</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline form-white mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <label class="form-label text-white" for="password">Password</label>
                    </div>

                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Simple link -->
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="{{ route('register') }}">Register</a></p>
                    </div>
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
