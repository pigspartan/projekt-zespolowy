<x-layout>


    @auth
        <h1 class="m-8">Hello to my Viscous Guide and Overview</h1>
        <button onclick="location.href='{{ route('listItem') }}'">Dodaj ogłoszenie</button>
    @endauth

    <div>
        <select class="text-black" onchange="window.location.href=this.value" name="perPage" id="perPage">
            <option @if ($perPage == 2)
                selected="selected"
            @endif value="{{route('index',['perPage' => 2])}}">2</option>
            <option @if ($perPage == 5)
                selected="selected"
            @endif value="{{route('index',['perPage' => 5])}}">5</option>
            <option @if ($perPage == 10)
                selected="selected"
            @endif value="{{route('index',['perPage' => 10])}}">10</option>
            <option @if ($perPage == 50)
                selected="selected"
            @endif value="{{route('index',['perPage' => 50])}}">50</option>
        </select>
        @foreach ($listings as $item)
            <h2>{{ $item->title }}</h2>
            <p>{{ $item->content }}</p>
            <h3>{{ $item->user->name }}</h3>
            <img src={{ asset('storage/' . $item->path) }} alt="huhma">
        @endforeach
    </div>

    <div>
        {{ $listings->links() }}
    </div>


    @guest

    @endguest
</x-layout>
