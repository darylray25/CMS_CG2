@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Articles Title -->
        <div class="text-center mb-4">
            <h1 class="font-weight-bold text-dark" style="font-size: 2.5rem;">Articles</h1>
        </div>

        <!-- Articles Loop -->
        @forelse ($articles as $article)
            <div class="mb-4">
                <!-- Article Title -->
                <div class="text-center mb-4">
                    <h2 class="font-weight-bold text-dark" style="font-size: 2rem;">{{ $article->title }}</h2>
                </div>

                <!-- Article Media -->
                @if($article->image)
                    <div class="text-center mb-4">
                        @if (in_array(pathinfo($article->image, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Image -->
                            <img src="{{ asset('storage/media/' . $article->image) }}" class="img-fluid mb-4" alt="{{ $article->title }}" style="width: 800px; height: 400px; object-fit: cover;">
                        @elseif (in_array(pathinfo($article->image, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'mkv']))
                            <!-- Video -->
                            <video controls class="img-fluid mb-4" style="width: 800px; height: 400px;">
                                <source src="{{ asset('storage/media/' . $article->image) }}" type="video/{{ pathinfo($article->image, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                @endif

                <!-- Article Content -->
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No articles found.</p>
        @endforelse

        <!-- Back Button -->
        <div class="container">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary mb-5">Back to Articles</a>
        </div>

        <!-- Optional content to maintain spacing before the footer -->
        <div class="spacer mb-5"></div>
    </div>
@endsection
