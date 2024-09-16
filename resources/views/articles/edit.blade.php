@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="my-4">Edit Article</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
                    </div>
                    
                    <!-- Content Field -->
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content }}</textarea>
                    </div>
                    
                    <!-- Media Upload -->
                    <div class="form-group mt-3">
                        <label for="image" class="form-label">Media (optional)</label>

                       <!-- <input type="file" class="form-control-file" id="image" name="image"> -->
                       <input type="file" class="form-control-file" id="image" name="image" accept="image/*,video/*" onchange="previewFile()" >
                       <div id="preview" class="mt-3" style="width: 400px; height: 300px;"></div>
                       
                        <!-- Display Uploaded Media -->
                        @if($article->image)
                            <div class="mt-3">
                                @php
                                    $extension = pathinfo($article->image, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Display Image -->
                                    <img src="{{ asset('storage/media/' . $article->image) }}" class="img-fluid" alt="{{ $article->title }}" style="width: 400px; height: 300px; object-fit: cover;">
                                @elseif (in_array($extension, ['mp4', 'avi', 'mov', 'mkv']))
                                    <!-- Display Video -->
                                    <video controls class="img-fluid" style="width: 400px; height: 300px;">
                                        <source src="{{ asset('storage/media/' . $article->image) }}" type="video/{{ $extension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @endif

                       
                        
                    </div>
                    
                    <!-- Buttons -->
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


    <script>
        function previewFile() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('image').files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const fileType = file.type.split('/')[0];
                    let media;

                    if (fileType === 'image') {
                        media = `<img src="${e.target.result}" alt="Preview" class="img-fluid" style="max-width: 100%; height: auto;">`;
                    } else if (fileType === 'video') {
                        media = `<video controls class="w-100"><source src="${e.target.result}" type="${file.type}">Your browser does not support the video tag.</video>`;
                    }

                    preview.innerHTML = media;
                };

                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }
    </script>
@endsection
