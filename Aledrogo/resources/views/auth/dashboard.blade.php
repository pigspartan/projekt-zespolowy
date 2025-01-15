<x-layout>
    @auth


    @endauth
    <div class="ml-60 mr-60 min-w-min">
        <h1 class="PageTitle">List of Your listed listings</h1>
        @foreach ($items as $key => $item)
        <div class="p-4 flex {{$key % 2 == 0 ? "bg-sky-950" : "bg-blue-900"}}">
                <img class="w-32 h-fit mt-auto mb-auto" src="{{asset('storage/'.$item->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->title}}</p>
                    <p>Description: {{$item->content}}</p>
                    <p>Seller:<a href="backend.html"> {{$item->user->name}}</a></p>
            </div>
            <div class="flex ml-auto">
                <button onclick="location.href='{{route('delete',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-orange-600 hover:bg-red-700 text-black">DELETE</button>
            </div>
        </div>
        @endforeach
    </div>



    @guest

    @endguest
</x-layout>
