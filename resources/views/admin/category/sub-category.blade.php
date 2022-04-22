@foreach ($categories as $category)
    <option value="{{ $category->id }}" @if (old('parent_id') == $category->id) selected @endif>
        {{ str_repeat('-', $level) . $category->name }}</option>
    @includeWhen(count($category->subCategories) > 0, 'admin.category.sub-category', [
        'categories' => $category->subCategories,
        'level' => $level + 1,
    ])
@endforeach
