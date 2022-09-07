@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <h2>Добавить новость</h2>
    @include('inc.message')
    <form method="post" action="{{ route('admin.news.store', ['status=1']) }}">
        @csrf
        <div class="form-group">
            <label for="category_id" @error('category_id') style="color:red" @enderror>Выбрать категорию</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="0">Выбрать</option>
                @foreach($categoriesList as $category)
                <option value="{{ $category->id }}" @if(old('category_id')===$category->id) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="author_id" @error('author_id') style="color:red" @enderror>Выбрать автора</label>
            <select class="form-control" name="author_id" id="author_id">
                <option value="0">Выбрать</option>
                @foreach($authorsList as $author)
                <option value="{{ $author->id }}" @if(old('author_id')===$author->id) selected @endif>{{ $author->name }}</option>
                @endforeach

            </select>
            {{ $authorsList->links() }}
        </div>
        <div class="form-group">
            <label for="title" @error('title') style="color:red" @enderror>Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
        <br>
        <div class="form-group">
            <label for="status" @error('status') style="color:red" @enderror>Статус</label>
            <select class="form-control" name="status" id="status">
                <option @if(old('status')==='DRAFT' ) selected @endif>DRAFT</option>
                <option @if(old('status')==='ACTIVE' ) selected @endif>ACTIVE</option>
                <option @if(old('status')==='BLOCKED' ) selected @endif>BLOCKED</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="image" @error('image') style="color:red" @enderror>URL изображения</label>
            <input type="text" class="form-control" name="image" id="image" value="{{ old('image') }}">
        </div>
        <br>
        <div class="form-group">
            <label for="description" @error('description') style="color:red" @enderror>Описание</label>
            <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="link" @error('link') style="color:red" @enderror>URL источника</label>
            <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection