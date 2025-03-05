<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Laravel App</title>
    <!-- Thêm CSS, JS,... -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
        <!-- Navbar hoặc header -->
    </header>
    <main class="py-4">
        @yield('content')
    </main>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
