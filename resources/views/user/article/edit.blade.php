@extends('guest.layout.master')
@section('page-title', __('Update an article'))
@section('content')
    <section class="single">
        <div class="container">
            <h1 class="h4 text-primary">{{ __('Update an article') }}</h1>
            <div class="row">
                @include('guest.layout.message')
                <div class="col-md-12">
                    <a href="javascript:history.back()" class="btn btn-link"> <i
                            class="ione ion-android-arrow-dropleft"></i> {{ __('Back') }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('user.articles.update', $article->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $article->id }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Categories:') }}</label>
                                <div class="row categories-list">
                                    @foreach ($categories as $category)
                                        <div class="col-md-4">
                                            <label for="item{{ $category->id }}"><input type="checkbox"
                                                    name="categories[]" id="item{{ $category->id }}"
                                                    value="{{ $category->id }}"
                                                    @if ($articleCategories->contains('id', $category->id)) checked @endif>
                                                {{ $category->name }}</label>
                                            @if (count($category->subCategories) > 0)
                                                @include(
                                                    'user.article.sub-categories-edit',
                                                    [
                                                        'categories' => $category->subCategories,
                                                        'articleCategories' => $articleCategories,
                                                    ]
                                                )
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($article->existImage())
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img class="img-rounded"
                                                src="{{ asset('storage/' . $article->cover_image) }}" alt="">
                                        </div>
                                    </div>
                                @endif

                            </div>
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
                                    placeholder="{{ __('Tiêu đề dài tối đa 255 ký tự!') }}"
                                    value="{{ old('title') ?? $article->title }}">
                                @error('title')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Content: ') }}</label>
                                <textarea name="content" id="editor" cols="30" rows="10"
                                    class="form-control">{{ old('content') ?? $article->content }}</textarea>
                            </div>
                        </div>
                        <div class="form-btn">
                            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="#" class="btn btn-primary pull-right"
                                onclick="event.preventDefault();document.getElementById('delete').submit()">{{ __('Delete') }}</a>

                        </div>
                    </form>
                    <form id="delete" action="{{ route('user.articles.destroy', $article->id) }}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>

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
