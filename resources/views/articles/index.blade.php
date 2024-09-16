@extends('layouts.app')

@section('content')
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid text-center" style="background-image: url('{{ asset('images/coastguard-wallpaper.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container py-5">
            <h1 class="display-4 font-weight-bold text-dark">Welcome to the Philippine Coast Guard</h1>
            <p class="lead font-weight-light text-dark">Stay updated with the latest news and stories from the Philippine Coast Guard.</p>
        </div>
    </div>

    <!-- Articles Section -->
    <div class="container mt-5">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <!-- Article Image -->
                        @if($article->image)
                            <img src="{{ asset('storage/images/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-image.jpg') }}" class="card-img-top" alt="Default Image" style="height: 220px; object-fit: cover;">
                        @endif

                        <!-- Article Content -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark font-weight-bold">{{ $article->title }}</h5>
                            <p class="card-text text-dark">{{ Str::limit($article->content, 100) }}</p>
                        </div>

                        <!-- Card Footer with Buttons -->
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                                <div>
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline-warning btn-sm text-dark">Edit</a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm text-dark">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
