@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="my-4">Edit Article</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content }}</textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="image" class="form-label">Image (optional)</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @if($article->image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/images/' . $article->image) }}" class="img-fluid" alt="{{ $article->title }}" style="width: 400px; height: 300px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Optional content to maintain spacing before the footer -->
        <div class="spacer mb-5"></div>
    </div>
@endsection
