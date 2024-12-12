<x-layout>

    <p class="PageTitle">Login</p>
    <div class="ContentBox">
        <div class=" p-8 w-max m-auto">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label class="m-8" for="email">Email</label>
                    <input class="DefaultInput" type="email" name="email">
                </div>
                <div class="text-xl max-w-screen-md flex flex-wrap items-center justify-between p-4">
                    <label for="password">Password</label>
                    <input class="DefaultInput type="password" name="password">
                </div>
                @error('failed')
                        <p>{{ $message }}</p>
                @enderror
                <div class="p-4">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Remember me </label>
                </div>
                <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-4">
                    <button class="DefaultButton">Login</button>
                </div>
            </form>
            <div class="max-w-screen-md flex flex-col flex-wrap items-center justify-between mx-auto p-2">
                <form action="{{route('password.request')}}"><button class="text-sm content-center p-0.5 hover:italic text-orange-400">i forgor hasła 💀</button></form>
            </div>
        </div>
    </div>
</x-layout>

