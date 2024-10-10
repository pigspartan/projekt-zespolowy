<x-layout>

    <p>Helo to my Register Guide and Overview</p>

    <div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">Username</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>
            <button>Register</button>
        </form>
    </div>

</x-layout>

