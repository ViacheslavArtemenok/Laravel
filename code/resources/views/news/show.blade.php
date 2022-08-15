@extends('layouts.main') @section('title') {{ $news['title'] }} @parent @endsection @section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Категория: {{$news['category']}}</h1>
        </div>
    </div>
</section>
<div class="col">
    <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>{{ $news['title'] }}</title>
            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $news['title'] }}</text>
        </svg>

        <div class="card-body">
            <p class="card-text">{!! $news['description'] !!}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('news.index', ['id' => $news['category_id']]) }}" class="btn btn-sm btn-outline-secondary">Назад к новостям</a>
                </div>
                <small class="text-muted">{{ $news['author'] }} - {{ $news['created_at']->format('d-m-Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection