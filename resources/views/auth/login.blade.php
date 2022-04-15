@extends('guest.layout.master')
@section('page-title', __('Login page'))
@section('content')
    {{-- begin login --}}
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ __('Login') }}</h4>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group @error('email') has-error @enderror">
                                <label>{{ __('Email') }}</label>
                                <input type="text" name="email" class="form-control rounded" autocomplete="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="help-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('email') has-error @enderror">
                                @if (Route::has('password.request'))
                                    <label class="fw">{{ __('Password') }}
                                        <a href="{{ route('password.request') }}"
                                            class="pull-right">{{ __('Forgot Password?') }}</a>
                                    </label>
                                @endif
                                <input type="password" name="password" class="form-control rounded"
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">{{ __('Login') }}</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">{{ __("Don't have an account?") }}</span> <a
                                    href="{{ route('register') }}">{{ __('Create one') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end login --}}
@endsection
