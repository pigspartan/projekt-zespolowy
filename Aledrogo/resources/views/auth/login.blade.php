<x-layout>
    <p class="pageTitle">Zaloguj się</p>
    <div class="contentBox pb-4">
            <form class="defaultForm" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="formElement">
                    <label class="defaultLabel" for="email">Email</label>
                    <input class="defaultInput" type="email" name="email">
                </div>
                <div class="formElement">
                    <label class="defaultLabel" for="password">Hasło</label>
                    <input class="defaultInput" type="password" name="password">
                </div>
                @error('failed')
                        <p>{{ $message }}</p>
                @enderror
                <div class="p-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Zapamiętaj logowanie</label>
                </div>
                <div class="centerDiv">
                    <button class="defaultButton">Login</button>
                </div>
            </form>
            <div class="centerDiv">
                <form action="{{route('password.request')}}"><button class="text-sm content-center p-0.5 text-orange-500 dark:text-orange-400">Przypomnij hasło</button></form>
            </div>
        </div>
</x-layout>

