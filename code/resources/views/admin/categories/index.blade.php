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
                    <a href="javascript:;" class="delete" rel="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" style="color: red;">Уд.</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Записей не найдено</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div id="csrf">@csrf</div>
    <div id="method">@method('delete')</div>
</div>
@endsection
@push('js')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        let elements = document.querySelectorAll(".delete");
        elements.forEach(function(e, k) {
            e.addEventListener("click", function() {
                const route = e.getAttribute('rel');
                if (confirm('Желаете удалить запись?')) {
                    const form = document.createElement('form');
                    form.action = route;
                    form.method = 'post';
                    form.insertAdjacentHTML('afterbegin', document.getElementById('csrf').innerHTML);
                    form.insertAdjacentHTML('afterbegin', document.getElementById('method').innerHTML);
                    document.body.append(form);
                    form.submit();
                } else {
                    alert("Удаление отменено!");
                }
            })
        });
    });
</script>
@endpush