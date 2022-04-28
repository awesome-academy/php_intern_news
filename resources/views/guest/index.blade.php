@extends('guest.layout.master')
@section('page-title', __('MAGZ News'))
@section('content')
    <section>
        <div class="container">
            <div class="line">
                <div>{{ __('NEWS') }}</div>
            </div>
            <div class="row">
                @foreach ($articleList as $article)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">

                            <article class="article col-md-12">
                                <div class="inner">
                                    <figure>
                                        <a href="{{ route('guest.articles.show', $article->slug) }}">
                                            @if ($article->existImage())
                                                <img src="{{ asset('storage/' . $article->cover_image) }}"
                                                    alt="{{ $article->title }}">
                                            @endif
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <div class="detail">
                                            <div class="time">{{ $article->published_at }}</div>
                                            <div class="category">{{ $article->getCategoriesString() }}</div>
                                        </div>
                                        <h2><a
                                                href="{{ route('guest.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                        </h2>
                                        <p></p>
                                        <footer>
                                            <a href="{{ route('guest.articles.show', $article->slug) }}"
                                                class="btn btn-primary more">
                                                <div class="">
                                                    {{ __('More') }}
                                                </div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row text-center">
                {!! $articleList->links('vendor.pagination.custom1') !!}
            </div>
        </div>
    </section>
    <section></section>
    <section></section>
    <section></section>
@endsection
