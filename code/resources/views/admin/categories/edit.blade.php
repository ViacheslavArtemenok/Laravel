@extends('layouts.admin')
@section('content')
<br>
<div class="offset-2 col-8">
    <h2>Редактировать категорию</h2>
    @include('inc.message')
    <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title" @error('title') style="color:red" @enderror>Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
        </div>
        <div class="form-group">
            <label for="description" @error('description') style="color:red" @enderror>Описание</label>
            <textarea class="form-control" name="description" id="description">{!! $category->description !!}</textarea>
        </div><br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection