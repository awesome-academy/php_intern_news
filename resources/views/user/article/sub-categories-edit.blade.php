<ul>
    @foreach ($categories as $category)
        <li>
            <label for="item{{ $category->id }}"><input type="checkbox" name="categories[]"
                    id="item{{ $category->id }}" value="{{ $category->id }}"
                    @if ($articleCategories->contains('id', $category->id)) checked @endif> {{ $category->name }}</label>
        </li>
        @includeWhen(count($category->subCategories) > 0, 'user.article.sub-categories-edit', [
            'categories' => $category->subCategories,
            'articleCategories' => $articleCategories,
        ])
    @endforeach
</ul>
