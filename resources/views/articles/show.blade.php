@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Article Title -->
        <h1 class="my-4">{{ $article->title }}</h1>

        <!-- Article Image -->
        @if($article->image)
            <img src="{{ asset('storage/images/' . $article->image) }}" class="img-fluid mb-4" alt="{{ $article->title }}" style="width: 800px; height: 400px; object-fit: cover;">
        @endif

        <!-- Article Content -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="card-text">{{ $article->content }}</p>
            </div>
        </div>

        <!-- Back Button -->
        <div class="container">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary mb-5">Back to Articles</a>
        </div>

        <!-- Optional content to maintain spacing before the footer -->
        <div class="spacer mb-5"></div>
    </div>
@endsection
