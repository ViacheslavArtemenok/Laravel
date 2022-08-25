@extends('layouts.admin')
@section('content')
<h2>Список авторов</h2>
<br>
<a href="{{ route('admin.authors.create')}}" class="btn btn-primary">Добавить автора</a>
<div class="table-responsive">
</div>
<br>
<div class="table-responsive">
    <!--@include('inc.message', ['message' => 'Это сообщение об ошибки в новостях'])-->
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Автор</th>
                <th scope="col">Телефон</th>
                <th scope="col">Почта</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authorsList as $key => $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->phone }}</td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->created_at }}</td>
                <td><a href="{{ route('admin.authors.edit', ['author' => $author->id]) }}">Ред.</a> &nbsp; <a href="" style="color: red;">Уд.</a></td>
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