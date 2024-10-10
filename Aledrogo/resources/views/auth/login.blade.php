<x-layout>

    <p class="text-4xl m-8 text-center">Helo to my Login Guide and Overview</p>

    <div class="m-8 border-2">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                <label for="email">Email</label>
                <input type="email" name="email">
            </div>
            <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between mx-auto p-4">
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <div class="max-w-screen-md items-center justify-between mx-auto p-4">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember"> Remember me </label>
            </div>
            @error('failed')
                    <p>{{ $message }}</p>
                @enderror
            <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">    
                <button class="text-xl content-center border-2 p-2">Login</button>
            </div>
        </form>
    </div>

</x-layout>

