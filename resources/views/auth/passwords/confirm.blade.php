@extends('guest.layout.master')
@section('page-title',__('Confirm Password'))
@section('content')
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h1 class="h4">{{ __('Confirm Password') }}</h1>
                        <h5>{{ __('Please confirm your password before continuing.') }}</h5>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password" class="text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <div class="text-center offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
