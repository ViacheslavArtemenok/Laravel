@extends('layouts.admin')
@section('content')
<h2>Категории новостей</h2>
<br>
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
<div class="table-responsive">
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @include('inc.message')
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <th scope="col">id</th>
                <th scope="col">Автор</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categoriesList as $key => $category)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->id }}</td>
                <td>Admin</td>
                <td>{{ $category->created_at }}</td>
                <td style="display: flex; gap: 10px;">
                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">Ред.</a>&nbsp;
                    <label for="btn_delete_{{ $category->id }}" style="color: red; cursor: pointer; text-decoration:underline;">Уд.</label>
                    <form method="post" action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" hidden>
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" style="padding: 0px 4px; box-sizing:border-box;" id="btn_delete_{{ $category->id }}" type="submit">Уд.</button>
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
</div>
@endsection
<!-- @push('js')
<script>
    alert("Hello World");
</script>
@endpush-->