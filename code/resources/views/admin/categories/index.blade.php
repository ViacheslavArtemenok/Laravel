@extends('layouts.admin')
@section('content')
<h2>Категории новостей</h2>
<br>
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
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
                <th scope="col">Автор</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categoriesList as $key => $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>Admin</td>
                <td>DRAFT</td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">Ред.</a> &nbsp; <a href="" style="color: red;">Уд.</a></td>
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
<!-- @push('js')
<script>
    alert("Hello World");
</script>
@endpush-->