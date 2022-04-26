@extends('admin.layout.master')
@section('title', __('Article Management'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('Article Management') }}</h1>
                    </div>
                    <div class="content">
                        @include('guest.layout.message')
                        <table class="table table-hover">
                            <thead>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Categories') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Options') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td><a
                                                href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a>
                                        </td>
                                        <td>{{ $article->getCategoriesString() }}</td>
                                        <td>{{ $article->created_at }}</td>
                                        <td>{{ $article->author->name }}</td>
                                        <td><span class="badge badge-{{ $article->publish_status['style'] }}">
                                                {{ $article->publish_status['string'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.articles.change-status', [
                                                'id' => $article->id,
                                                'status' => config('custom.article_status.approved'),
                                            ]) }}"
                                                class="btn btn-success">{{ __('Approve') }}</a>
                                            <a href="{{ route('admin.articles.change-status', [
                                                'id' => $article->id,
                                                'status' => config('custom.article_status.rejected'),
                                            ]) }}"
                                                class="btn btn-danger">{{ __('Reject') }}</a>
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
