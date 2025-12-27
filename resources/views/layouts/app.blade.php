<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seleção de Vagas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Laravel Echo e Pusher para WebSockets -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.min.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Sistema para acompanhameto de escolhas de Vagas</h1>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                @auth
                    <a href="{{ route('operador.index') }}" class="hover:underline">Painel Operador</a>
                    <a href="{{ route('militares.index') }}" class="hover:underline">Militares</a>
                    <a href="{{ route('unidades.index') }}" class="hover:underline">Unidades</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="hover:underline">Usuários</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

