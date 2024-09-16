@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Edit Article</h1>

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-5">
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title Field -->
                    <div class="form-group mb-4">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control rounded-pill" id="title" name="title" value="{{ $article->title }}" placeholder="Enter article title" required>
                    </div>
                    
                    <!-- Content Field -->
                    <div class="form-group mb-4">
                        <label for="content" class="form-label fw-bold">Content</label>
                        <textarea class="form-control rounded" id="content" name="content" rows="6" placeholder="Write your content here..." required>{{ $article->content }}</textarea>
                    </div>
                    
                    <!-- Media Upload -->
                    <div class="form-group mb-4">
                        <label for="image" class="form-label fw-bold">Image/Video (optional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*,video/*" onchange="previewFile()">
                        <div class="d-flex justify-content-center">
                            <div id="preview" class="mt-3" style="max-width: 60%; height: auto;"></div>
                        </div>

                        <!-- Display Uploaded Media -->
                        @if($article->image)
                            <div class="mt-3 text-center">
                                @php
                                    $extension = pathinfo($article->image, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                         <!-- Display Image -->
                                    <img src="{{ asset('storage/media/' . $article->image) }}" class="img-fluid rounded" alt="{{ $article->title }}" style="max-width: 60%; height: auto;">

                                    @elseif (in_array($extension, ['mp4', 'avi', 'mov', 'mkv']))
                                        <!-- Display Video -->
                                        <video controls class="w-100 rounded" style="max-width: 60%; height: auto;">
                                            <source src="{{ asset('storage/media/' . $article->image) }}" type="video/{{ $extension }}">
                                            Your browser does not support the video tag.
                                        </video>
                             

                                @endif
                            </div>
                        @endif
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill custom-width">Update</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg rounded-pill custom-width ms-3">Cancel</a>
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
                        media = `<img src="${e.target.result}" alt="Preview" class="img-fluid rounded" style="max-width: 100%; height: auto;">`;
                    } else if (fileType === 'video') {
                        media = `<video controls class="w-100 rounded"><source src="${e.target.result}" type="${file.type}">Your browser does not support the video tag.</video>`;
                    }

                    preview.innerHTML = media;
                };

                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }
    </script>

    <style>
        .form-control {
            padding: 15px;
            font-size: 16px;
        }

        .form-control-file {
            padding: 10px;
        }

        .card {
            border-radius: 15px;
        }

        .btn {
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0047ab;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .card-body {
                padding: 20px;
            }
        }

        .custom-width {
            width: 200px;
        }

        .btn-primary {
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0047ab;
        }
    </style>
@endsection
