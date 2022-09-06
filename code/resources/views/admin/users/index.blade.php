@extends('layouts.admin')
@section('content')
<h2>Список пользователей</h2>
<br>
<div class="table-responsive">
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @include('inc.message')
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">id</th>
                <th scope="col">Администратор</th>
                <th scope="col">Телефон</th>
                <th scope="col">Почта</th>
                <th scope="col">Дата регистрации</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usersList as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastName }}</td>
                <td>{{ $user->id }}</td>
                <td>@if($user->is_admin) Да @else Нет @endif</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Ред.</a> &nbsp;
                    <a href="javascript:;" class="delete" rel="{{ route('admin.users.destroy', ['user' => $user->id]) }}" style="color: red;">Уд.</a>

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
    {{ $usersList->links() }}
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