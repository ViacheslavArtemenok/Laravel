@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <h2>Категории новостей</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Наименование</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categoriesList as $key => $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Записей не найдено</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br>
    <h2>Добавить новость</h2>
    @if($errors->any())
    @foreach($errors->all() as $error)
    @include('inc.message', ['message' => $error])
    @endforeach
    @endif

    <form method="post" action="{{ route('admin.news.store', ['status=1']) }}">
        @csrf
        <div class="form-group">
            <label for="id">id категории</label>
            <input type="text" class="form-control" name="id" id="id" value="{{ old('id') }}">
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description" value="{!! old('description') !!}"></textarea>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" name="author" id="author" value="{!! old('author') !!}">
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>

@endsection