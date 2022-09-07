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
                    <img src="{{ Auth::user()->avatar }}" style="max-width: 200px; border-radius: 20px; margin-bottom: 40px;" alt="Avatar">
                    <br>
                    <p>Имя: {{ Auth::user()->name }}</p>
                    <p>Фамилия: {{ Auth::user()->lastName }}</p>
                    <p>Телефон: {{ Auth::user()->phone }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Дата регистрации: {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                    <p>Последняя авторизация:
                        @if(Auth::user()->last_login_at)
                        {{ Auth::user()->last_login_at->format('H:i:s d.m.Y') }}
                        @else{{ Auth::user()->created_at->format('H:i:s d.m.Y') }}
                        @endif
                    </p>
                </div>
            </div>
            <br>
            <a href="{{ route('account.edit', ['account' => Auth::user()->id]) }}" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
</div>
@endsection