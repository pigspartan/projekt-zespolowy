<x-layout>
    @auth


    @endauth
    <h1 class="text-center text-3xl m-8">List of listed listings</h1>
    <div>
        <select class="text-black" onchange="window.location.href=this.value" name="perPage" id="perPage">
            <option @if ($perPage == 2)
                selected="selected"
            @endif value="{{route('perPage',['perPage' => 2])}}">2</option>
            <option @if ($perPage == 5)
                selected="selected"
            @endif value="{{route('perPage',['perPage' => 5])}}">5</option>
            <option @if ($perPage == 10)
                selected="selected"
            @endif value="{{route('perPage',['perPage' => 10])}}">10</option>
            <option @if ($perPage == 50)
                selected="selected"
            @endif value="{{route('perPage',['perPage' => 50])}}">50</option>
        </select>
        @foreach ($listings as $key => $item)
        <div class="flex flex-wrap mx-auto ml-60 mr-60 p-4 {{$key % 2 == 0 ? "bg-indigo-900" : "bg-indigo-950"}}">
            <img class="max-w-32" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-wrap m-6">
                <p class="text-xl font-bold">{{$item->title}}</p>
                <p>Description: {{$item->content}}</p>
                <p>Seller:<a href="backend.html"> {{$item->user->name}}</a></p>
            </div>
            <button onclick="location.href='{{route('index')}}'" class="border-2 rounded w-20 h-20 mt-auto mb-auto ml-auto mr-32 bg-amber-300 text-black">BUY</button>
        </div>
        @endforeach
    </div>

    <div class="items-center flex" style="width:100%;">
        <div style="margin:auto">
            {{ $listings->links() }}
        </div>
    </div>

    @guest

    @endguest
</x-layout>
