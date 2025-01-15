<x-layout>
    <div class="pageContent">
        <div class="pageTitle">
            Wprowadź nowe dane
        </div>
        <div class="contentBox">
         {{-- pod 'status' jest info zwrotne z serwera --}}
            <form action="{{route('password.update')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <div class="formElement">
                    <label class="defaultLabel" for="email">Email</label>
                    <input class="defaultInput" type="text" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">
                    {{ $message }}</p>
                @enderror
                <div class="formElement">
                    <label class="defaultLabel" for="password">Password</label>
                    <input class="defaultInput" type="password" name="password">
                </div>
                @error('password')
                <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">
                    {{ $message }}</p>
                @enderror
                <div class="formElement">
                    <label class="defaultLabel" for="password_confirmation">Confirm Password</label>
                    <input class="defaultInput" type="password" name="password_confirmation">
                </div>
                <div class="centerDiv mb-4">
                    <button class="defaultButton">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
