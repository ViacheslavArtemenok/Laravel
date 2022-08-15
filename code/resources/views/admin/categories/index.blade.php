@extends('layouts.admin')
@section('content')
<h2>Категории новостей</h2>
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
            @forelse($categoriesList as $key => $categories)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $categories }}</td>
                <td>Admin</td>
                <td>DRAFT</td>
                <td>{{ date('d-m-Y H:i') }}</td>
                <td><a href="{{ route('admin.categories.edit', ['category' => $key]) }}">Ред.</a> &nbsp; <a href="" style="color: red;">Уд.</a></td>
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