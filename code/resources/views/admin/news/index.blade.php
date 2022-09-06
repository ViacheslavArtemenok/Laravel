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
                    <a href="javascript:;" class="delete" rel="{{ route('admin.news.destroy', ['news' => $news->id]) }}" style="color: red;">Уд.</a>
                </td>
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