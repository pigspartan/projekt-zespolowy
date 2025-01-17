<x-layout>
    @vite(['resources/js/dogscript.js'])
    @auth
    @endauth
    <div class="pageContent">
        <div class="pageTitle">Ogłoszenia użytkownika {{$userName}}</div>
        @if($listings)
        @foreach ($listings as $key => $item)
        <div class="listing {{$key % 2 == 0 ? "bg-gray-400 dark:bg-gray-800" : "bg-gray-300 dark:bg-slate-800"}}">
            <img class="w-32 h-fit mt-auto mb-auto" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-wrap m-6 min-w-32">
                <p class="text-xl font-bold">{{$item->title}}</p>
                <p>Description: {{$item->content}}</p>
                <p>Seller:<a href='{{route('userListings',['id' => $item->user->id])}}'> {{$item->user->name}}</a></p>
            </div>
            <div class="flex ml-auto">
                <div class="mt-auto mr-2 mb-auto flex">
                    <p class="text-2xl m-auto mr-4">Price: <span class="goldText">{{$item->price}}</span> zł</p>
                <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 bg-amber-300 hover:bg-amber-500 text-black">Kup</button>
                </div>
            </div>
        </div>
        @endforeach

            <div class="pagination">
                <select class="paginationSelect" onchange="window.location.href=this.value" name="perPage" id="perPage">
                    <option @if ($perPage == 2)
                                selected="selected"
<<<<<<< HEAD
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
=======
                            @endif value="{{route('userListings',['id' => $id,'perPage' => 2])}}">2</option>
                    <option @if ($perPage == 5)
                                selected="selected"
                            @endif value="{{route('userListings',['id' => $id,'perPage' => 5])}}">5</option>
                    <option @if ($perPage == 10)
                                selected="selected"
                            @endif value="{{route('userListings',['id' => $id,'perPage' => 10])}}">10</option>
                    <option @if ($perPage == 50)
                                selected="selected"
                            @endif value="{{route('userListings',['id' => $id,'perPage' => 50])}}">50</option>
>>>>>>> dac39aab11c3bf0fa0d59e121e02749363a9492f
                </select>
                <div id="strony" class="flex m-2">
                    <div class="my-auto mr-4">elementów na stronie</div>
                    {{ $listings->links() }}
                </div>
            </div>
        @endif
    </div>



    @guest

    @endguest
</x-layout>
