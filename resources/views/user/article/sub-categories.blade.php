<ul>
    @foreach ($categories as $category)
        <li><label for="item{{ $category->id }}"><input type="checkbox" name="categories[]"
                    id="item{{ $category->id }}" value="{{ $category->id }}"
                    @if (is_array(old('categories')) && in_array($category->id, old('categories'))) checked @endif> {{ $category->name }}</label></li>
        @if (count($category->subCategories) > 0)
            @include('user.article.sub-categories', [
                'categories' => $category->subCategories,
            ])
        @endif
    @endforeach
</ul>
