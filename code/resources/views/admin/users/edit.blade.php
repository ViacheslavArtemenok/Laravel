@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <br>
    <h2>Редактировать данные пользователя</h2>
    @include('inc.message')

    <form method="post" action="{{ route('admin.users.update', ['user' => $user]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name" @error('name') style="color:red" @enderror>Имя</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="lastName" @error('lastName') style="color:red" @enderror>Имя</label>
            <input type="text" class="form-control" name="lastName" id="lastName" value="{{ $user->lastName }}">
        </div>
        <div class="form-group">
            <label for="phone" @error('phone') style="color:red" @enderror>Телефон</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
        </div>
        <div class="form-group">
            <label for="email" @error('email') style="color:red" @enderror>Электронная почта</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="is_admin" @error('is_admin') style="color:red" @enderror>Выбрать статус</label>
            <select class="form-control" name="is_admin" id="is_admin">
                <option value="0">Пользователь</option>
                <option value="1" @if($user->is_admin) selected @endif>Админ</option>
            </select>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection