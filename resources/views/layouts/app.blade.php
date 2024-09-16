<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Philippine Coast Guard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('articles.index') }}">Philippine Coast Guard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.create') }}">Create Article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
                </li>
            </ul>
        </div>
    </nav> -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
    <a class="navbar-brand" href="{{ route('articles.index') }}">Philippine Coast Guard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('articles.create') }}">Create Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
            </li>
        </ul>
    </div>
    </nav>



    <!-- Main Content -->
    <main role="main" class="flex-shrink-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-1">© {{ date('Y') }} Philippine Coast Guard. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
