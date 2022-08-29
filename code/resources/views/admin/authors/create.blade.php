@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <br>
    <h2>Добавить источник</h2>

    @if($errors->any())
    @foreach($errors->all() as $error)
    @include('inc.message', ['message' => $error])
    @endforeach
    @endif

    <form method="post" action="{{ route('admin.authors.store', ['status=1']) }}">
        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="text">Об авторе</label>
            <textarea class="form-control" name="text" id="text">{!! old('text') !!}</textarea>
        </div><br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection