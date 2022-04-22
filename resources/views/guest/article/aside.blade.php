@if (count($recents) > 0)
    <aside>
        <h1 class="aside-title">{{ __('Recent Post') }}</h1>
        <div class="aside-body">
            {{-- main recent article --}}
            <article class="article-fw">
                <div class="inner">
                    <figure>
                        <a href="{{ route('guest.articles.show', $recents->get(0)->slug) }}">
                            <img src="{{ asset('storage/' . $recents->get(0)->cover_image) }}">
                        </a>
                    </figure>
                    <div class="details">
                        <h1><a
                                href="{{ route('guest.articles.show', $recents->get(0)->slug) }}">{{ $recents->get(0)->title }}</a>
                        </h1>
                        <p>
                            {{ $recents->get(0)->excerp }}
                        </p>
                        <div class="detail">
                            <div class="time">{{ $recents->get(0)->published_at }}</div>
                            <div class="category"><a href="#">{{ $recents->get(0)->getCategoriesString() }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="line"></div>
            {{-- some more recent articles --}}
            @for ($i = 1; $i < count($recents); $i++)
                <article class="article-mini">
                    <div class="inner">
                        <figure>
                            <a href="{{ route('guest.articles.show', $recents->get($i)->slug) }}">
                                <img src="{{ asset('storage/' . $recents->get($i)->cover_image) }}">
                            </a>
                        </figure>
                        <div class="padding">
                            <h1><a
                                    href="{{ route('guest.articles.show', $recents->get($i)->slug) }}">{{ $recents->get($i)->title }}</a>
                            </h1>
                            <div class="detail">
                                <div class="category"><a
                                        href="#">{{ $recents->get($i)->getCategoriesString() }}</a>
                                </div>
                                <div class="time">{{ $recents->get($i)->published_at }}</div>
                            </div>
                        </div>
                    </div>
                </article>
            @endfor
        </div>
    </aside>
@endif
