@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Create New Article</h1>

        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control rounded-pill" id="title" name="title" placeholder="Enter article title" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="content" class="form-label fw-bold">Content</label>
                        <textarea class="form-control rounded" id="content" name="content" rows="6" placeholder="Write your content here..." required></textarea>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="image" class="form-label fw-bold">Image/Video</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*,video/*" onchange="previewFile()">
                        <div class="d-flex justify-content-center">
                            <div id="preview" class="mt-3" style="max-width: 60%; height: auto;"></div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill custom-width">Submit Article</button>
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

        .btn {
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0047ab;
        }
    </style>
@endsection
