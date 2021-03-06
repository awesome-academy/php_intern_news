<ul class="dropdown-menu">
    @foreach ($categories as $category)
        <li class="dropdown">
            <a href="{{ route('guest.categories.show', $category->slug) }}">{{ $category->name }}
                @if (count($category->subCategories) > 0)
                    <i class="ion-ios-arrow-right"></i>
                @endif
            </a>
            @includeWhen(count($category->subCategories) > 0, 'guest.layout.sub-category', [
                'categories' => $category->subCategories,
            ])
        </li>
    @endforeach
</ul>
