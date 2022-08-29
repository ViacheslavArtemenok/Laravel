@extends('layouts.admin')
@section('content')
<h2>Категории новостей</h2>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Все новости
    </button>
    <ul class="dropdown-menu">
        @foreach($categoriesList as $key => $category)
        <li><a class="dropdown-item" href="{{ route('admin.news.show', ['news' => $category->id]) }}">{{ $category->title }}</a></li>
        @endforeach
    </ul>
</div>
<br>
<h2>Список новостей</h2>
<br>
<a href="{{ route('admin.news.create')}}" class="btn btn-primary">Добавить новость</a>
<br>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <br>
        @include('inc.message')
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <th scope="col">id</th>
                <th scope="col">Категория</th>
                <th scope="col">Автор</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($newsList as $key => $news)
            <tr>
                <td>{{ $key +1 }}</td>
                <td>{{ $news->title }}</td>
                <td>{{ $news->id }}</td>
                <td>{{ $news->category->title }}</td>
                <td>{{ $news->author->name }}</td>
                <td>{{ $news->status }}</td>
                <td>{{ $news->created_at }}</td>
                <td><a href="{{ route('admin.news.edit', ['news' => $news->id]) }}">Ред.</a> &nbsp;
                    <label for="btn_delete_{{ $news->id }}" style="color: red; cursor: pointer; text-decoration:underline;">Уд.</label>
                    <form method="post" action="{{ route('admin.news.destroy', ['news' => $news->id]) }}" hidden>
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" style="padding: 0px 4px; box-sizing:border-box;" id="btn_delete_{{ $news->id }}" type="submit">Уд.</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Записей не найдено</td>
            </tr>

            @endforelse
        </tbody>
    </table>
    {{ $newsList->links() }}
</div>
@endsection