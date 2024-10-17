<x-layout>
    @auth

    @endauth
        <h1 class="text-center text-3xl m-8">List of listed listings</h1>
    @foreach ($listings as $key => $item)
        <div class="flex flex-wrap mx-auto ml-60 mr-60 p-4 {{$key % 2 == 0 ? "bg-indigo-900" : "bg-indigo-950"}}">
            <img class="max-w-32" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-wrap m-6">
                <p class="text-xl font-bold">{{$item->title}}</p>
                <p>Description: {{$item->content}}</p>
                <p>Seller:<a href="backend.html"> {{$item->user->name}}</a></p>
            </div>
            <button onclick="location.href='{{route('indexc')}}'" class="border-2 rounded w-20 h-20 mt-auto mb-auto ml-auto mr-32 bg-amber-300 text-black">BUY</button>
        </div>
        @endforeach

    @guest

    @endguest
</x-layout>

