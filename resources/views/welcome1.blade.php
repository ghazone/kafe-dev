<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>

<body>

    <h1 class="text-center mt-3">Selamat datang di Aplikasi CRUD Laravel 11</h1>
    <div class="text-center justify-content-end mt-3">
        <a href="{{ route('login') }}" class="btn btn-outline-transparant me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-transparant">Register</a>
    </div>

</body>

</html>
