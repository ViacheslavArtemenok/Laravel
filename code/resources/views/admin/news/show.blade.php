@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <h2>Категории новостей</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Выбрано</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td><a class="nav-link" href="{{ route('admin.news.index') }}">Все новости</a></td>
                    <td>-</td>
                </tr>
                @foreach($categoriesList as $key => $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    @if($category->title == $category_title)
                    <td><a class="nav-link" style="color:#0d6efd" href="{{ route('admin.news.show', ['news' => $category->id]) }}">{{ $category->title }}</a></td>
                    <td><svg style="color:#0d6efd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                        </svg></td>
                    @else
                    <td><a class="nav-link" href="{{ route('admin.news.show', ['news' => $category->id]) }}">{{ $category->title }}</a></td>
                    <td>-</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <h2>Список новостей</h2>
    <br>
    <a href="{{ route('admin.news.create')}}" class="btn btn-primary">Добавить новость</a>
    <div class="table-responsive">
    </div>
    <br>
    <div class="table-responsive">
        <!--@include('inc.message', ['message' => 'Это сообщение об ошибки в новостях'])-->
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
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
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $category_title }}</td>
                    <td>{{ $news->author_name }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->created_at }}</td>
                    <td><a href="{{ route('admin.news.edit', ['news' => $news->id]) }}">Ред.</a> &nbsp; <a href="" style="color: red;">Уд.</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Записей не найдено</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endsection