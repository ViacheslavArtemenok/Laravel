@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('inc.message')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>Имя: {{ Auth::user()->name }}</p>
                    <p>Фамилия: {{ Auth::user()->lastName }}</p>
                    <p>Телефон: {{ Auth::user()->phone }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Дата регистрации: {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                </div>
            </div>
            <br>
            <a href="{{ route('account.edit', ['account' => Auth::user()->id]) }}" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
</div>
@endsection