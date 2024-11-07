<x-layout>
    @auth


    @endauth
    <div class="ml-60 mr-60 min-w-min">
        <h1 class="text-center text-3xl p-4 bg-blue-900">List of listed listings</h1>
        @foreach ($listings as $key => $item)
        <div class="p-4 flex {{$key % 2 == 0 ? "bg-sky-950" : "bg-blue-900"}}">
                <img class="max-w-32" src="{{asset('storage/'.$item->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->title}}</p>
                    <p>Description: {{$item->content}}</p>
                    <p>Seller:<a href="backend.html"> {{$item->user->name}}</a></p>
            </div>
            <div class="flex ml-auto">
                <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-amber-300 hover:bg-amber-500 text-black">BUY</button>
            </div>
        </div>
        @endforeach

        <div class="flex justify-center items-center bg-sky-700">
            <div class="flex justify-center items-center space-x-4 mx-auto">
                <select class="text-black m-2 rounded p-2" onchange="window.location.href=this.value" name="perPage" id="perPage">
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
                <div class="m-2">
                    {{ $listings->links() }}
                </div>
            </div>
        </div>
    </div>

    

    @guest

    @endguest
</x-layout>
