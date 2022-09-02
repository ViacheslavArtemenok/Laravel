@extends('layouts.admin')
@section('content')
<h2>Список авторов</h2>
<br>
<a href="{{ route('admin.authors.create')}}" class="btn btn-primary">Добавить автора</a>
<div class="table-responsive">
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @include('inc.message')
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Автор</th>
                <th scope="col">id</th>
                <th scope="col">Телефон</th>
                <th scope="col">Почта</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authorsList as $key => $author)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->id }}</td>
                <td>{{ $author->phone }}</td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->created_at }}</td>
                <td><a href="{{ route('admin.authors.edit', ['author' => $author->id]) }}">Ред.</a> &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ route('admin.authors.destroy', ['author' => $author->id]) }}" style="color: red;">Уд.</a>

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
    {{ $authorsList->links() }}
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