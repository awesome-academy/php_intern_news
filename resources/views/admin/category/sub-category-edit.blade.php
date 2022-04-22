@foreach ($categories as $item)
    @if ($item->id == $category->id)
        @continue
    @endif
    <option value="{{ $item->id }}" @if (old('parent_id') == $item->id || $category->parent_id == $item->id) selected @endif>
        {{ str_repeat('-', $level) . $item->name }}</option>
    @includeWhen(count($item->subCategories) > 0, 'admin.category.sub-category-edit', [
        'categories' => $item->subCategories,
        'level' => $level + 1,
    ])
@endforeach
