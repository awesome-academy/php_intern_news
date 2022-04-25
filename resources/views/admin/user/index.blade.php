@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('Writer Management') }}</h1>
                    </div>
                    <div class="content">
                        @include('guest.layout.message')
                        <table class="table table-hover">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Updated at') }}</th>
                                <th>{{ __('Status') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <form class="form-inline"
                                                action="{{ route('admin.users.change-status', $user->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <select name="status" class="form-control" id="">
                                                        @for ($i = 0; $i < count($status); $i++)
                                                            <option value="{{ $i + 1 }}"
                                                                @if ($user->status == $i + 1) selected @endif>
                                                                {{ $status[$i] }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <button class="btn btn-success" type="submit">
                                                    {{ __('Save Change') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="footer">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
