@extends('guest.layout.master')
@section('page-title', $article->title)
@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-4 sidebar" id="sidebar">
                    @include('guest.article.aside')
                </div>
                <div class="col-md-8">
                    <article class="article main-article">
                        <header>
                            <h1>{{ $article->title }}</h1>
                            <ul class="details">
                                <li>{{ __('Posted on') }} {{ $article->published_at }}</li>
                                <li><a>{{ $article->getCategoriesString() }}</a></li>
                                <li>{{ __('By') }} <a href="#">{{ $article->author->name }}</a></li>
                            </ul>
                        </header>
                        <div class="main">
                            {!! $article->content !!}
                        </div>
                        <footer>

                        </footer>
                    </article>
                    @include('guest.article.suggest')
                    <div class="line thin"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
