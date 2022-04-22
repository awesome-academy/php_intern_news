<div class="line">
    <div>{{ __('You May Also Like') }}</div>
</div>
<div class="row">
    @foreach ($suggests as $article)
        <article class="article related col-md-6 col-sm-6 col-xs-12">
            <div class="inner">
                <figure>
                    <a href="{{ route('guest.articles.show', $article->slug) }}">
                        <img src="{{ asset('storage/' . $article->cover_image) }}">
                    </a>
                </figure>
                <div class="padding">
                    <h2><a href="{{ route('guest.articles.show', $article->slug) }}">{{ $article->title }}</a></h2>
                    <div class="detail">
                        <div class="category"><a href="#">{{ $article->getCategoriesString() }}</a></div>
                        <div class="time">{{ $article->published_at }}</div>
                    </div>
                </div>
            </div>
        </article>
    @endforeach
</div>
