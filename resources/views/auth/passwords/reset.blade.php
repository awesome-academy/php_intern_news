@extends('guest.layout.master')
@section('page-title', __('Reset Password'))
@section('content')
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ __('Reset Password') }}</h4>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password" class="text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group mb-0">
                                <div class="text-center offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
