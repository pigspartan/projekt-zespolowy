<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <header>
        <nav>
        @guest
        <a href="{{ route('index') }}">Home</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endguest
        <h1>Nav</h1>
        @auth
        <p class="username">{{auth()->user()->name}}</p>
        <form action="{{ route('logout') }}" method="post">
        @csrf 
        <button>logout</button>
        </form>
        @endauth
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
