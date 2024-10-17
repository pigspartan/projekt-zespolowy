<x-layout>

    <p class="text-4xl m-8 text-center">Strona rejestracji użytkownika</p>

    <div class="m-8">
        <form action="{{ route('register') }}" method="POST">
            @csrf
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                    <label for="name">Username</label>
                    <input class="rounded" type="text" name="name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                @enderror

                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                    <label for="email">Email</label>
                    <input class="rounded" type="text" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                @enderror

                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                    <label for="password">Password</label>
                    <input class="rounded" type="password" name="password">
                </div>
                @error('password')
                    <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                @enderror
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="rounded" type="password" name="password_confirmation">
                </div>
                
                <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">
                    <button class="rounded-lg text-xl content-center border-2 p-2">Register</button>
                </div>
        </form>
    </div>

</x-layout>

