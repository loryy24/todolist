<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoList | @yield('title')</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
    </style>
    @stack('styles')
</head>
<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ route('categories.index') }}">
                    Ma ToDoList
                </a>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <span class="fw-semibold text-muted">
                        👤{{ Auth::user()->name }}
                    </span>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Modifier profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-danger">Se déconnecter</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container">
        @yield('content')
    </main>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    {{-- jQuery requis pour DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>