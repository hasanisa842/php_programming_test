<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-white">
                <h4>@yield('name')</h4>
            </a>
            <a class="navbar-brand text-white" href="{{ route('dashboard') }}">
                <h4>Dashboard</h4>
            </a>
            <a class="navbar-brand text-white" href="{{ route('users.index') }}">
                <h4>Users</h4>
            </a>
            <a class="navbar-brand text-white" href="{{ route('login.register') }}">
                <h4>Login/Register</h4>
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>