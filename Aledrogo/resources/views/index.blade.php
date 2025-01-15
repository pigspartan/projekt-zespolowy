<x-layout>
    @vite(['resources/js/dogscript.js'])
    @auth


    @endauth

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="ml-60 mr-60 min-w-min">
        <div class="PageTitle">Lista ogłoszeń</div>
        @foreach ($listings as $key => $item)
        <div class="p-4 m-3 rounded-xl shadow-lg flex {{$key % 2 == 0 ? "bg-gray-800" : "bg-slate-800"}}">
            <img class="w-32 h-fit mt-auto mb-auto rounded" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-wrap m-6 min-w-32">
                <p class="text-xl font-bold">{{$item->title}}</p>
                <p>Description: {{$item->content}}</p>
                <p>Seller:<a href='{{route('userListings',['id' => $item->user->id])}}'> {{$item->user->name}}</a></p>
            </div>

            <div class="flex ml-auto">
                <div class="mt-auto mr-2 mb-auto flex">
                    <p class="text-2xl m-auto mr-4">Price: <span class="text-amber-300">{{$item->price}}</span> zł</p>
                    <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl px-2 h-12 bg-amber-300 hover:bg-amber-500 text-black">Szczegóły</button>
                </div>
            </div>
        </div>
        @endforeach

        <div class="flex justify-center items-center max-w-max ml-auto rounded px-2 mr-4 bg-slate-700">
            <div class="flex justify-center items-center space-x-4 max-w-max mx-auto">
                <select class="text-black my-2 ml-2 rounded p-2" onchange="window.location.href=this.value" name="perPage" id="perPage">
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
                <div id="strony" class="flex m-2">
                    <div class="my-auto mr-4">elementów na stronie</div>
                    {{ $listings->links() }}
                </div>
            </div>
        </div>
    </div>



    @guest

    @endguest
</x-layout>
