@extends('layouts.main')
@section('title') {{ $newsList[0]->category->title}}: Список новостей @parent @endsection
@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Категория: {{ $newsList[0]->category->title }}</h1>
            <p class="lead text-muted">{{ $newsList[0]->category->description }}</p>
            <p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary my-2">Назад</a>
            </p>
        </div>
    </div>
</section>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @forelse($newsList as $key => $news)
    <div class="col">
        <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>{{ $news->title }}</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ mb_substr($news->title, 0, 20). '...'}}</text>
            </svg>
            <div class="card-body">
                <img src="{{ $news->image }}" width="64" height="48" style="border-radius:6px" alt="image">
                <p class="card-text">{!!mb_substr($news->description, 0, 80) . '...'!!}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('news.show', ['id' => $news->id]) }}" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                    </div>
                    <small class="text-muted">{{ $news->author->name }} - {{ $news->created_at }}</small>
                </div>
            </div>
        </div>
    </div>
    @empty
    <h2>Записей нет</h2>
    @endforelse
</div>
{{ $newsList->links() }}
@endsection