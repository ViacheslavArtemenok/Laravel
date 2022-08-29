@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <h2>Редактировать новость</h2>
    @if($errors->any())
    @foreach($errors->all() as $error)
    @include('inc.message', ['message' => $error])
    @endforeach
    @endif
    <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="category_id">Выбрать категорию</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="0">Выбрать</option>
                @foreach($categoriesList as $category)
                <option value="{{ $category->id }}" @if($news->category->id === $category->id) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="author_id">Выбрать автора</label>
            <select class="form-control" name="author_id" id="author_id">
                <option value="{{ $news->author->id }}">Выбрано ({{ $news->author->name }})</option>
                @foreach($authorsList as $author)
                <option value="{{ $author->id }}" @if($news->author->id === $author->id) selected @endif>{{ $author->name }}</option>
                @endforeach

            </select>
            {{ $authorsList->links() }}
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">
        </div>
        <br>
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option @if($news->status === 'DRAFT' ) selected @endif>DRAFT</option>
                <option @if($news->status === 'ACTIVE' ) selected @endif>ACTIVE</option>
                <option @if($news->status === 'BLOCKED' ) selected @endif>BLOCKED</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="image">URL изображения</label>
            <input type="text" class="form-control" name="image" id="image" value="{{ $news->image }}">
        </div>
        <br>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description">{!! $news->description !!}</textarea>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>

@endsection