@extends('layouts.admin')
@section('content')
<h2>Список ссылок на ресурсы</h2>
<br>
<a href="{{ route('admin.resources.create')}}" class="btn btn-primary">Добавить ссылку</a>
<div class="table-responsive">
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @include('inc.message')
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ресурс</th>
                <th scope="col">id</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($resourcesList as $key => $resource)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $resource->link }}</td>
                <td>{{ $resource->id }}</td>
                <td>{{ $resource->created_at }}</td>
                <td><a href="{{ route('admin.resources.edit', ['resource' => $resource->id]) }}">Ред.</a> &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ route('admin.resources.destroy', ['resource' => $resource->id]) }}" style="color: red;">Уд.</a>

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
    {{ $resourcesList->links() }}
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