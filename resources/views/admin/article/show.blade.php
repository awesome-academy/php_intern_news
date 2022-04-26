@extends('admin.layout.master')
@section('title', __('View Article'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('View Article') }}</h1>
                    </div>
                    <div class="content">
                        @include('guest.layout.message')
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-info">&LeftTriangle;
                            {{ __('Back') }}</a>
                        <h2 class="h4 text-info">{{ $article->title }}</h2>
                        <p class="text-muted"> <strong>{{ __('Slug') }}:</strong> {{ $article->slug }}</p>
                        <p class="text-muted"> <strong>{{ __('Author') }}:</strong> {{ $article->author->name }} -
                            {{ $article->author->username }}</p>
                        <p class="text-muted"> <strong>{{ __('Created at') }}:</strong> {{ $article->created_at }}
                        </p>
                        <p class="text-muted"> <strong>{{ __('Updated at') }}:</strong> {{ $article->created_at }}
                        </p>
                        <p class="text-muted"> <strong>{{ __('Categories') }}:</strong>
                            {{ $article->getCategoriesString() }}</p>
                        <p class="text-muted"> <strong>{{ __('Status') }}:</strong>
                            {{ $article->publish_status['string'] }}
                        </p>
                        <div class="content container">
                            {!! $article->content !!}
                        </div>
                        <div class="footer">
                            <a href="{{ route('admin.articles.change-status', [
                                'id' => $article->id,
                                'status' => config('custom.article_status.approved'),
                            ]) }}"
                                class="btn btn-success">{{ __('Approve') }}</a>
                            <a href="{{ route('admin.articles.change-status', [
                                'id' => $article->id,
                                'status' => config('custom.article_status.rejected'),
                            ]) }}"
                                class="btn btn-danger pull-right">{{ __('Reject') }}</a>


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
