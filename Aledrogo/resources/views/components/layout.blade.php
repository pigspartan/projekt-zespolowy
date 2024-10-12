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
    <header class="bg-indigo-900">
        <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" aria-label="Global">
            <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{URL::asset('/img/glorp.jpg')}}" alt="glorp logo" class="h-12"/>
                <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">GlorpCorp©™</span>
            </a>
            @guest
            <div class="flex items-end space-x-3 rtl:space-x-reverse">
                <a class="text-xl" href="{{ route('login') }}">Login</a>
                <a class="text-xl" href="{{ route('register') }}">Register</a>
            </div>
            @endguest
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
