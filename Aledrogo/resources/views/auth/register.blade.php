<x-layout>
    <p class="pageTitle">Utwórz konto</p>
    <div class="contentBox">
        <form class="defaultForm" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="formElement">
                <label class="defaultLabel" for="name">Nazwa użytkownika</label>
                <input class="defaultInput" type="text" name="name" value="{{ old('name') }}">
            </div>
            @error('name')
            <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
            @enderror
            <div class="formElement">
                <label class="defaultLabel" for="email">Email</label>
                <input class="defaultInput" type="text" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
            @enderror
            <div class="formElement">
                <label class="defaultLabel" for="password">Hasło</label>
                <input class="defaultInput" type="password" name="password">
            </div>
            @error('password')
            <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
            @enderror
            <div class="formElement">
                <label class="defaultLabel" for="password_confirmation">Potwierdź hasło</label>
                <input class="defaultInput" type="password" name="password_confirmation">
            </div>
            <div class="centerDiv mt-4">
                <button class="defaultButton">Utwórz konto</button>
            </div>
        </form>
    </div>
</x-layout>

