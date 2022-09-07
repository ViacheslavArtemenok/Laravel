@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <br>
    <h2>Добавить источник</h2>

    @include('inc.message')

    <form method="post" action="{{ route('admin.authors.store', ['status=1']) }}">
        @csrf
        <div class="form-group">
            <label for="name" @error('name') style="color:red" @enderror>Имя</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="phone" @error('phone') style="color:red" @enderror>Телефон</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="email" @error('email') style="color:red" @enderror>Электронная почта</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="text" @error('text') style="color:red" @enderror>Об авторе</label>
            <textarea class="form-control" name="text" id="text">{!! old('text') !!}</textarea>
        </div><br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection