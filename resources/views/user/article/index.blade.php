@extends('guest.layout.master')
@section('page-title', __('Article Management'))
@section('content')
    <section class="single">
        <div class="container">
            <h1 class="h4 text-info">{{ __('Your articles') }}:</h1>
            @include('guest.layout.message')
            <div class="text-right my-5">
                <a href="{{ route('user.articles.create') }}" class="position-absolute btn btn-primary btn-rounded"><i
                        class="ione ion-android-add"></i>
                    {{ __('Create new article') }}</a>
            </div>

            <table class="table table-hover">
                <thead>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Categories') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Options') }}</th>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td class="text-muted">{{ $article->created_at }}</td>
                            <td><a href="{{ route('user.articles.edit', $article->id) }}">{{ $article->title }}</a>
                            </td>
                            <td class="text-muted">{{ $article->getCategoriesString() }}</td>
                            <td><span
                                    class="badge badge-{{ $article->publish_status['style'] }}">{{ $article->publish_status['string'] }}</span>
                            </td>
                            <td>
                                <a href="{{ route('user.articles.edit', $article->id) }}" class="btn text-muted"
                                    title="{{ __('Edit') }}"><i class="ione ion-edit"></i></a>
                                <a href="#"><i class="ione ion-ios-trash" title="{{ __('Delete') }}"
                                        onclick="event.preventDefault();document.getElementById('delete{{ $article->id }}').submit()"></i></a>

                                @if ($article->published == config('custom.article_status.no_publish'))
                                    <a href="#" class="btn text-info" title="{{ __('Request publish') }}"
                                        onclick="event.preventDefault();document.getElementById('publish{{ $article->id }}').submit()">
                                        <i class="ione ion-earth"></i></a>
                                @endif

                            </td>
                        </tr>
                        <form action="{{ route('user.articles.destroy', $article->id) }}"
                            id="delete{{ $article->id }}" method="post">
                            @csrf
                            @method('delete')
                        </form>

                        @if ($article->published == config('custom.article_status.no_publish'))
                            <form id="publish{{ $article->id }}"
                                action="{{ route('user.articles.publish', $article->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="{{ config('custom.article_status.pending') }}">
                            </form>
                        @endif
                    @endforeach
                </tbody>
            </table>

            {!! $articles->links() !!}
        </div>
    </section>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
