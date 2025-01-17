<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/lightdarkmode.js'])
</head>
<body>
    <header>
        <nav aria-label="Global">
            <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{URL::asset('/img/glorp.jpg')}}" alt="glorp logo" class="h-12"/>
                <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">GlorpCorp©™</span>
            </a>
            @guest
                <div class="flex items-end space-x-3 rtl:space-x-reverse">
                    <button id="toggleMode"></button>
                    <a class="authButton" href="{{ route('login') }}">Login</a>
                    <a class="authButton" href="{{ route('register') }}">Rejestracja</a>
                </div>
            @endguest
            @auth
                <div class="flex items-start">
                    <button class="navButton" onclick="location.href='{{route('index')}}'">Ogłoszenia</button>
                    <button class="navButton" onclick="location.href='{{route('listItem')}}'">Dodaj ogłoszenie</button>
                    <form action="{{ route('paypal.payout') }}" method="POST">
                        @csrf
                        <button type="submit" class="navButton">Wypłata</button>
                    </form>
                    @role('Admin')
                        <button class="navButton" onclick="location.href='{{route('admin.dashboard')}}'">Admin dashboard</button>
                    @endrole
                    <button class="navButton" onclick="location.href='{{route('transactions.userTransactions', ['id' => auth()->id()])}}'">Twoje transakcje</button>
                    <button class="navButton" onclick="location.href='{{route('message')}}'">Wiadomości</button>
                </div>
                <div class="flex items-end space-x-3 rtl:space-x-reverse">
                    <button id="toggleMode"></button>
                    <p class="bigButton"><a href="{{route('dashboard')}}">{{auth()->user()->name}}</a></p>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="smallButton">Logout</button>
                    </form>
                    @role('Suspended')
                    <a class="text-red-600 text-sm" href="{{route('suspended')}}">Suspended</a>
                    @endrole
                </div>
            @endauth
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    {{-- <footer class="mt-8">
        <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" aria-label="Global">
            @guest
            @endguest
            @auth
            @endauth
        </nav>
    </footer> --}}
</body>

</html>
