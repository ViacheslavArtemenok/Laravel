@extends('layouts.admin')
@section('content')
@php $message = "Test message"; @endphp
<br>
@include('inc.message')
<br>
<a class="btn btn-primary" href="{{ route('admin.parser')}}">Выполнить парсинг новостей</a>
@endsection