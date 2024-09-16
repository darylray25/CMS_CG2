@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="font-weight-bold text-dark" style="font-size: 3rem; letter-spacing: 1px;">Articles</h1>
            <p class="lead text-muted">Explore the latest news and updates</p>
        </div>

        <!-- Articles Loop -->
        <div class="row">
            @forelse ($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <!-- Article Media -->
                        @if($article->image)
                            @php
                                $extension = pathinfo($article->image, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Image -->
                                <img src="{{ asset('storage/media/' . $article->image) }}" class="card-img-top article-media" alt="{{ $article->title }}">
                            @elseif (in_array($extension, ['mp4', 'avi', 'mov', 'mkv']))
                                <!-- Video -->
                                <video controls class="card-img-top article-media">
                                    <source src="{{ asset('storage/media/' . $article->image) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endif

                        <!-- Article Body -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text flex-fill">{{ Str::limit($article->content, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read More</a>
                        </div>

                        <!-- Article Footer -->
                        <div class="card-footer text-muted">
                            Published on {{ $article->created_at->format('F j, Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-12">No articles found.</p>
            @endforelse
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg">Back to Articles</a>
        </div>

        <!-- Optional content to maintain spacing before the footer -->
        <div class="spacer mb-5"></div>
    </div>
@endsection

<style>
    /* General Styles */
    body {
        font-family: 'Georgia', serif;
        color: #333;
    }

    .container {
        max-width: 1200px;
    }

    .card {
        border-radius: 0.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        height: 160px; /* Adjust this value as needed */
        overflow: hidden;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: #666;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-footer {
        background-color: #f8f9fa;
        font-size: 0.875rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Media Styles */
    .article-media {
        object-fit: cover;
        height: 200px;
        transition: transform 0.3s ease;
    }

    .article-media:hover {
        transform: scale(1.1);
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1rem;
        }
    }
</style>
