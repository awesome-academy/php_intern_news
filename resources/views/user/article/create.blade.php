@extends('guest.layout.master')
@section('page-title', __('Write a new post'))
@section('content')
    <section class="single">
        <div class="container">
            <h1 class="h4 text-primary">{{ __('Write a new post') }}</h1>

            <form action="{{ route('user.articles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">{{ __('Categories:') }}</label>
                        <div class="row categories-list">
                            @foreach ($categories as $category)
                                <div class="col-md-4">
                                    <label for="item{{ $category->id }}"><input type="checkbox" name="categories[]"
                                            id="item{{ $category->id }}" value="{{ $category->id }}"
                                            @if (is_array(old('categories')) && in_array($category->id, old('categories'))) checked @endif>
                                        {{ $category->name }}</label>
                                    @if (count($category->subCategories) > 0)
                                        @include('user.article.sub-categories', [
                                            'categories' => $category->subCategories,
                                        ])
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 @error('image') has-error @enderror">
                        <label for="">{{ __('Cover image:') }}</label>
                        <input type="file" name="image" id="" class="form-controll">
                        @error('image')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 @error('title') has-error @enderror">
                        <label for="">{{ __('Title: ') }}</label>
                        <input type="text" name="title" id="" class="form-control" max="255"
                            placeholder="{{ __('Tiêu đề dài tối đa 255 ký tự!') }}" value="{{ old('title') }}">
                        @error('title')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">{{ __('Content: ') }}</label>
                        <textarea name="content" id="editor" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="form-btn">
                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('/bower_components/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('scripts')

    @parent
    <script src="{{ asset('/bower_components/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('/js/editor.js') }}"></script>
@endsection
