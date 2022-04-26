@extends('guest.layout.master')
@section('page-title', __('Personal infomation'))
@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <h1 class="h3 text-primary">{{ __('Your personal information') }}</h1>
                    <br>
                    <form action="{{ route('user.info.change') }}" class="form" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="image avatar mb-5">
                            @if (file_exists('storage/' . $user->avatar))
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="">
                            @else
                                <img src="{{ asset('images/' . $user->avatar) }}" alt="">
                            @endif
                        </div>
                        <br>
                        <br>
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="" class="form-label text-muted">{{ __('Your name') }}</label>
                            <input type="text" name="name" id="" class="form-control"
                                value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <p class="help-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="text-muted"><span class="text-bold">{{ __('Email') }}</span>:
                            <span>{{ $user->email }}</span>
                        </p>
                        <p class="text-muted"><span class="text-bold">{{ __('Username') }}</span>:
                            <span>{{ $user->username }}</span>
                        </p>
                        <div class="form-group @error('image') has-error @enderror">
                            <label for="" class="text-muted">{{ __('Avatar picture') }}</label>
                            <input type="file" name="image" id="" accept="image/*" class="form-control">
                            @error('image')
                                <p class="help-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2 class="h3 text-center text-danger">{{ __('Change password') }}</h2>
                    <form action="{{ route('user.change-pass') }}" class="form" method="POST">
                        @csrf
                        <div class="form-group @error('old_password') has-error @enderror">
                            <label for="">{{ __('Old password') }}</label>
                            <input type="password" name="old_password" id="" class="form-control">
                            @error('old_password')
                                <p class="help-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group @error('new_password') has-error @enderror">
                            <label for="">{{ __('New password') }}</label>
                            <input type="password" name="new_password" id="" class="form-control">
                            @error('new_password')
                                <p class="help-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group @error('confirm') has-error @enderror">
                            <label for="">{{ __('Confirm') }}</label>
                            <input type="password" name="confirm" id="" class="form-control">
                            @error('confirm')
                                <p class="help-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">{{ __('Change password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
