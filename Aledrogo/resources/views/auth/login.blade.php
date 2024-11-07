<x-layout>


    <div class="items-center border-2" style="align-content: center; width:50%; min-width:max-content; margin:auto; margin-top:20px">
        <div class=" p-8 w-max"style="width: max-content; margin:auto">
            <p class="text-4xl m-8 text-center">Login</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label class="m-8" for="email">Email</label>
                    <input class="rounded" type="email" name="email">
                </div>
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label for="password">Password</label>
                    <input class="rounded" type="password" name="password">
                </div>
                @error('failed')
                        <p>{{ $message }}</p>
                @enderror
                <div class="p-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Remember me </label>
                </div>
                <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">
                    <button class="rounded-lg text-xl content-center border-2 p-2">Login</button>
                </div>
            </form>
            <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-2">
                <form action="{{route('password.request')}}"><button class="text-sm content-center p-0.5">i forgor 💀</button></form>
            </div>
        </div>
    </div>
</x-layout>

