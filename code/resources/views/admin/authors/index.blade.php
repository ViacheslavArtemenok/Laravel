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
                    <label for="btn_delete_{{ $author->id }}" style="color: red; cursor: pointer; text-decoration:underline;">Уд.</label>
                    <form method="post" action="{{ route('admin.authors.destroy', ['author' => $author->id]) }}" hidden>
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" style="padding: 0px 4px; box-sizing:border-box;" id="btn_delete_{{ $author->id }}" type="submit">Уд.</button>
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
    {{ $authorsList->links() }}
</div>
@endsection