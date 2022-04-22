<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <input type="text" name="name" id="name" value="{{ old('name') }}">
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    <select name="parent_id" id="">
        <option value="0">{{ __('None') }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if (old('parent_id') == $category->id) selected @endif>
                {{ $category->name }}</option>
            @includeWhen(count($category->subCategories) > 0, 'admin.category.sub-category', [
                'categories' => $category->subCategories,
                'level' => 1,
            ])
        @endforeach
    </select>
    <button type="submit">{{ __('Save') }}</button>
</form>
<table>
    <thead>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Parent') }}</th>
        <th>{{ __('Options') }}</th>
    </thead>
    <tbody>
        @foreach ($categoryList as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->category->name ?? '' }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}">{{ __('Edit') }}</a>
                    <a href="#"
                        onclick="event.preventDefault();document.getElementById('delete{{ $category->id }}').submit()">{{ __('Delete') }}</a>
                </td>
                <form id="delete{{ $category->id }}"
                    action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            </tr>
        @endforeach
    </tbody>
</table>
