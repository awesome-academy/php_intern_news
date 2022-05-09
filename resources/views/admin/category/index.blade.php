@extends('admin.layout.master')
@section('title', __('Category management'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('Category management') }}</h1>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-4">
                                @include('guest.layout.message')
                                <form class="form" action="{{ route('admin.categories.store') }}" method="post">
                                    @csrf
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="">{{ __('Category Name') }}:</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <p class="help-block">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Parent category') }}:</label>
                                        <select name="parent_id" class="form-control" id="">
                                            <option value="0">{{ __('None') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (old('parent_id') == $category->id) selected @endif>
                                                    {{ $category->name }}</option>
                                                @includeWhen(
                                                    count($category->subCategories) > 0,
                                                    'admin.category.sub-category',
                                                    [
                                                        'categories' => $category->subCategories,
                                                        'level' => 1,
                                                    ]
                                                )
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" id="btn-save" class="btn btn-primary">{{ __('Save') }}</button>
                                </form>
                            </div>
                        </div>


                        <table class="table table-hover">
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
                                            <a id="btn-edit-{{ $category->id }}"
                                                href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-primary">{{ __('Edit') }}</a>
                                            <a id="btn-delete-{{ $category->id }}" href="#"
                                                onclick="event.preventDefault();document.getElementById('delete{{ $category->id }}').submit()"
                                                class="btn btn-danger">{{ __('Delete') }}</a>
                                        </td>
                                        <form id="delete{{ $category->id }}"
                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
