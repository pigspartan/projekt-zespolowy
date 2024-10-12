<x-layout>


    @auth
        <h1 class="m-8">Hello to my Viscous Guide and Overview</h1>
        <form action="{{route('listings.store')}}" method="POST">
            @csrf
            <div>
                <label for="title">title</label>
                <input type="text" name="title" value="{{ old('title') }}">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="content">content</label>
                <textarea rows="5" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <button>create</button>
        </form>
         <p>{{session('succes')}}</p>
    @endauth

    @guest

    @endguest
    <p class="m-8">content strony głównej</p>
</x-layout>

