<form action="{{ route('admin.categories.update', $category->id) }}" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $category->id }}">
    <input type="text" name="name" value="{{ old('name') ?? $category->name }}">
    <select name="parent_id" id="">
        <option value="0">{{ __('None') }}</option>
        @foreach ($categories as $item)
            @if ($item->id == $category->id)
                @continue
            @endif
            <option value="{{ $item->id }}" @if (old('parent_id') == $item->id || $category->parent_id == $item->id) selected @endif>
                {{ $item->name }}</option>
            @includeWhen(count($item->subCategories) > 0, 'admin.category.sub-category-edit', [
                'categories' => $item->subCategories,
                'level' => 1,
            ])
        @endforeach
    </select>
    <button type="submit">{{ __('Save') }}</button>
</form>
