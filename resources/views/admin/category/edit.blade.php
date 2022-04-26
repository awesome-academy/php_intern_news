@extends('admin.layout.master')
@section('title', __('Edit category'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('Edit Category') }}</h1>
                    </div>
                    <div class="content">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-info">&LeftTriangle;
                            {{ __('Back') }}</a>
                        <div class="container">
                            @include('guest.layout.message')

                            <form class="form" action="{{ route('admin.categories.update', $category->id) }}"
                                method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label for=""> {{ __('Category name: ') }}</label>
                                    <input type="text" name="name" value="{{ old('name') ?? $category->name }}"
                                        class="form-control">
                                    @error('name')
                                        <p class="help-block">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('Parent category') }}</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="0">{{ __('None') }}</option>
                                        @foreach ($categories as $item)
                                            @if ($item->id == $category->id)
                                                @continue
                                            @endif
                                            <option value="{{ $item->id }}"
                                                @if (old('parent_id') == $item->id || $category->parent_id == $item->id) selected @endif>
                                                {{ $item->name }}</option>
                                            @includeWhen(
                                                count($item->subCategories) > 0,
                                                'admin.category.sub-category-edit',
                                                [
                                                    'categories' => $item->subCategories,
                                                    'level' => 1,
                                                ]
                                            )
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">{{ __('Save') }}</button>
                                <a href="#" class="btn btn-danger pull-left"
                                    onclick="event.preventDefault();document.getElementById('delete').submit()">{{ __('Delete') }}</a>
                            </form>
                            <form id="delete" action="{{ route('admin.categories.destroy', $category->id) }}"
                                method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
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
