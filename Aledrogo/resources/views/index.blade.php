<x-layout>


    @auth
        <h1 class="m-8">Hello to my Viscous Guide and Overview</h1>
        <button onclick="location.href='{{route('listItem')}}'">Dodaj ogłoszenie</button>
    @endauth

    @foreach ($listings as $item)
        <h2>{{$item->title}}</h2>
        <p>{{$item->content}}</p>
        <h3>{{$item->user->name}}</h3>
        <img src={{asset('storage/'.$item->path)}} alt="huhma">
    @endforeach

    @guest

    @endguest

</x-layout>

