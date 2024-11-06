<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex flex-col">
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
                <div class="flex items-start">
                    <button class="m-2 p-1 hover:bg-indigo-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">Dodaj ogłoszenie</button>
                    <button class="m-2 p-1 hover:bg-indigo-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">placeholder1</button>
                    <button class="m-2 p-1 hover:bg-indigo-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">placeholder2</button>
                    <button class="m-2 p-1 hover:bg-indigo-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">placeholder3</button>
                    <button class="m-2 p-1 hover:bg-indigo-800 border-r border-l rounded-xl" onclick="location.href='{{route('listItem')}}'">placeholder4</button>
                </div>
                <div class="flex items-end space-x-3 rtl:space-x-reverse">
                    <p class="username text-2xl hover:bg-indigo-800 p-1 border-r border-l rounded-lg"><a href="{{route('dashboard')}}">{{auth()->user()->name}}</a></p>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="border ml-2 mr-2 p-1 rounded hover:bg-indigo-800">logout</button>
                    </form>
                </div>
            @endauth
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="mt-8">
        <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" aria-label="Global">
            @guest
            @endguest
            @auth
            @endauth
        </nav>
    </footer>
</body>
</html>
