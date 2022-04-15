@extends('guest.layout.master')
@section('page-title', __('Reset Password'))
@section('content')
    {{-- begin reset --}}
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ __('Reset Password') }}</h4>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group @error('email') has-error @enderror">
                                <label>{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">{{ __('Back to login?') }}</span> <a
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end reset --}}
@endsection
