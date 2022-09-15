@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <br>
    <h2>Добавить ссылку на ресурс</h2>

    @include('inc.message')

    <form method="post" action="{{ route('admin.resources.store', ['status=1']) }}">
        @csrf
        <div class="form-group">
            <label for="link" @error('link') style="color:red" @enderror>Ссылка</label>
            <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}">
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection