<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoList | @yield('title')</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
        .sidebar {
            min-height: 100vh;
        }
        .sidebar .nav-link.active {
            background: #2563eb;
            color: #fff !important;
            border-radius: 4px;
        }
        .sidebar .nav-link {
            color: #333;
        }
        .sidebar .nav-link:hover {
            background: #e9ecef;
            color: #2563eb !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    @auth
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar verticale -->
        <nav class="sidebar bg-light border-end p-3" style="min-width:200px;">
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.index') ? 'active fw-bold' : '' }}" href="{{ route('categories.index') }}">
                        📂 Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.all') ? 'active fw-bold' : '' }}" href="{{ route('tasks.all') }}">
                        ✅ Toutes les tâches
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active fw-bold' : '' }}" href="{{ route('profile.edit') }}">
                        👤 {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-danger w-100 text-start">Se déconnecter</button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- Contenu principal -->
        <div class="flex-grow-1">
            <main class="container py-4">
                @yield('content')
            </main>
        </div>
    </div>
    @else
        <main class="container py-4">
            @yield('content')
        </main>
    @endauth

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>