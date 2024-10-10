<x-layout>

    <p>Helo to my Login Guide and Overview</p>

    <div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember"> remember me </label>
            @error('failed')
                    <p>{{ $message }}</p>
                @enderror
            <button>Login</button>
        </form>
    </div>

</x-layout>

