@extends('guest.layout.master')
@section('page-title', __('Register page'))
@section('content')

    {{-- begin register --}}
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ __('Register') }}</h4>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="form-group @error('name') has-error @enderror">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" autocomplete="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group @error('email') has-error @enderror">
                                <label>{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" autocomplete="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group @error('username') has-error @enderror">
                                <label>{{ __('Username') }}</label>
                                <input type="text" name="username" class="form-control" autocomplete="username"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group @error('password') has-error @enderror">
                                <label class="fw">{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control"
                                    autocomplete="current-password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Confirm password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">{{ __('Register') }}</button>
                            </div>

                            <div class="form-group text-center">
                                <span class="text-muted">{{ __('Already have an account?') }}</span> <a
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end register --}}
@endsection
