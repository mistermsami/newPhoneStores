@extends('layouts.auth')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <div class="text-center mb-5">
                <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
                    {{-- <img src="{{ asset('assets/img/logo.PNG') }}" width="121" height="auto" alt="Panther Force"> --}}
                    <img src="https://pantherforce.co.uk/cdn/shop/files/logo-pf_529ab6b6-8198-41c4-8071-3d610222d418_210x@2x.png?v=1720617728https://pantherforce.co.uk/cdn/shop/files/logo-pf_529ab6b6-8198-41c4-8071-3d610222d418_210x@2x.png?v=1720617728    " width="181" height="auto" alt="Panther Force">
                </a>
            </div>

            <h2 class="h2 text-center mb-4">
                Login to your account
            </h2>
            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email address
                    </label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com"
                        autocomplete="off" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-group input-group-flat">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Your password"
                            autocomplete="off">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <label for="remember" class="form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input" />
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="text-center text-secondary mt-3">
    Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">
        Sign up
    </a>

    <span class="form-label-description">
        <a href="{{ route('password.request') }}">I forgot password</a>
    </span>
</div> --}}
@endsection
