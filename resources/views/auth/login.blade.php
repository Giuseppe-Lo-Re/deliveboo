@extends('layouts.app')

@section('body_content')
    {{-- START CARD --}}
    <div class="ms_form-card-wrapper ms_form-card-wrapper-login d-flex">
                    
        <div class="ms_form-card ms_login-card">
            <div class="ms_form-card-header">Login</div>

            <div class="ms_form-card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="ms_input-hover-wrapper">
                        <label for="email" class="ms_js-get-label">Email</label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror ms_js-get-input" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="ms_input-hover-wrapper">
                        <label for="password" class="ms_js-get-label">Password</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror ms_js-get-input" name="password"  autocomplete="current-password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="text-center mb-4">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Ricordami</label>
                    </div>

                    <div class="text-center mb-4">
                        <button type="submit" class="ms_btn mb-2">Accedi</button>

                        @if (Route::has('password.request'))
                            <div class="ms_link">
                                <a href="{{ route('password.request') }}">Password dimenticata?</a>
                            </div>
                        @endif
                    </div>

                    <div class="text-center">
                        <div class="mb-2">
                            Non hai un account?
                        </div>
                        <a href="{{route('register')}}" class="ms_btn">Registrati</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END CARD --}}
@endsection
