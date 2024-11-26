<x-layout>
    <div class="items-center border-2 content-center border-black w-6/12 min-w-max m-auto bg-sky-950">
        <div class=" p-8 w-max m-auto">
            <p class="text-4xl m-8 text-center">Register</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                    <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                        <label class="pr-2" for="name">Username</label>
                        <input class="rounded pl-2" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                    @enderror

                    <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                        <label class="pr-2" for="email">Email</label>
                        <input class="rounded pl-2" type="text" name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                    @enderror

                    <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                        <label class="pr-2" for="password">Password</label>
                        <input class="rounded pl-2" type="password" name="password">
                    </div>
                    @error('password')
                        <p class="text-amber-500 text-lg max-w-screen-md flex flex-wrap items-center justify-between mx-auto pl-8 pr-8 pb-2 pt-2">{{ $message }}</p>
                    @enderror
                    <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                        <label class="pr-2" for="password_confirmation">Confirm Password</label>
                        <input class="rounded pl-2" type="password" name="password_confirmation">
                    </div>
                    
                    <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">
                        <button class="rounded-lg text-xl content-center border-2 p-2  hover:bg-blue-900 hover:border-black hover:text-black">Register</button>
                    </div>
            </form>
        </div>
    </div>

</x-layout>

