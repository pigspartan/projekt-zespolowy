<x-layout>


    <div class="items-center border-2 content-center border-black w-6/12 min-w-max m-auto bg-sky-950">
        <div class=" p-8 w-max m-auto">
            <p class="text-4xl m-8 text-center">Login</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label class="m-8" for="email">Email</label>
                    <input class="rounded pl-2" type="email" name="email">
                </div>
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label for="password">Password</label>
                    <input class="rounded pl-2" type="password" name="password">
                </div>
                @error('failed')
                        <p>{{ $message }}</p>
                @enderror
                <div class="p-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="hover:italic"> Remember me </label>
                </div>
                <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">
                    <button class="rounded-lg text-xl content-center border-2 p-2 hover:bg-blue-900 hover:border-black hover:text-black">Login</button>
                </div>
            </form>
            <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-2">
                <form action="{{route('login')}}"><button class="text-sm content-center p-0.5 hover:italic text-orange-400">i forgor hasła 💀</button></form>
            </div>
        </div>
    </div>
</x-layout>

