<x-layout>
    @vite(['resources/js/dogscript.js'])
    @auth


    @endauth
    <div class="ml-60 mr-60 min-w-min">
        <div class="PageTitle">List of listed listings by {{$userName}}</div>
        @if($listings)
        @foreach ($listings as $key => $item)
        <div class="p-4 flex {{$key % 2 == 0 ? "bg-sky-950" : "bg-blue-900"}}">
            <img class="w-32 h-fit mt-auto mb-auto" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-wrap m-6 min-w-32">
                <p class="text-xl font-bold">{{$item->title}}</p>
                <p>Description: {{$item->content}}</p>
                <p>Seller:<a href='{{route('userListings',['id' => $item->user->id])}}'> {{$item->user->name}}</a></p>
            </div>
            <div class="flex ml-auto">
                <div class="mt-auto mr-2 mb-auto flex">
                    <p class="text-2xl m-auto mr-4">Price: <span class="text-amber-300">{{$item->price}}</span> zł</p>
                <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 bg-amber-300 hover:bg-amber-500 text-black">BUY</button>
                </div>
            </div>
        </div>
        @endforeach


        <div class="flex justify-center items-center bg-sky-700">
            <div class="flex justify-center items-center space-x-4 mx-auto">
                <select class="text-black m-2 rounded p-2" onchange="window.location.href=this.value" name="perPage" id="perPage">
                    <option @if ($perPage == 2)
                        selected="selected"
                    @endif value="{{route('userListings',['id' => $item->user->id, 'perPage' => 2])}}">2</option>
                    <option @if ($perPage == 5)
                        selected="selected"
                    @endif value="{{route('userListings',['id' => $item->user->id, 'perPage' => 5])}}">5</option>
                    <option @if ($perPage == 10)
                        selected="selected"
                    @endif value="{{route('userListings',['id' => $item->user->id, 'perPage' => 10])}}">10</option>
                    <option @if ($perPage == 50)
                        selected="selected"
                    @endif value="{{route('userListings',['id' => $item->user->id, 'perPage' => 50])}}">50</option>
                </select>
                <div id="strony" class="m-2">
                    {{ $listings->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>



    @guest

    @endguest
</x-layout>
