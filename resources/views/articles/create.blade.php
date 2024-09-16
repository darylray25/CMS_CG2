@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="my-4">Create New Article</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="image" class="form-label">Image/Video</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*,video/*" onchange="previewFile()" >
                        <div id="preview" class="mt-3" style="width: 400px; height: 300px;"></div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
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
