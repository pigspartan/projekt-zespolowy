<x-layout>

    <p>Helo to my Login Guide and Overview</p>

    <div>
        <form action="{{ route('logiun') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <button>Login</button>
        </form>
    </div>

</x-layout>

