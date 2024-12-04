<x-layout>
    @vite(['resources/js/dogscript.js'])
    @auth


    @endauth
    <div class="grid grid-cols-2">
        <div class="ml-60 mr-60 min-w-min">
            <h1 class="text-center text-3xl p-4 bg-blue-900">Oflagowane ogłoszenia</h1>
            @foreach ($listings as $key => $item)
            <div class="p-4 flex {{$key % 2 == 0 ? "bg-sky-950" : "bg-blue-900"}}">
                <img class="w-32 h-fit mt-auto mb-auto" src="{{asset('storage/'.$item->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->title}}</p>
                    <p>Description: {{$item->content}}</p>
                    <p>Seller:<a href='{{route('userListings',['id' => $item->user->id])}}'> {{$item->user->name}}</a></p>
                    <p>Liczba flag: {{$item->timesFlagged}}</p>
                </div>
                <div class="flex ml-auto">
                    <button onclick="location.href='{{route('delete',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-orange-600 hover:bg-red-700 text-black">DELETE</button>
                    <button onclick="location.href='{{route('listing.unflag',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-green-600 hover:bg-green-700 text-black">UNFLAG</button>
                    <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-amber-300 hover:bg-amber-500 text-black">DETAILS</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="ml-60 mr-60 min-w-min">
            <h1 class="text-center text-3xl p-4 bg-blue-900">Użytkownicy</h1>
            @foreach ($users as $key => $item)
            <div class="p-4 flex {{$key % 2 == 0 ? "bg-sky-950" : "bg-blue-900"}}">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->name}}</p>
                    <p>Email: {{$item->email}}</p>
                    <div>
                        Role:
                            @foreach($item->roles as $rKey => $role)
                                {{$role->name}}
                            @endforeach
                    </div>
                    <div>
                        {{-- user->hasRole('nazwaRoli') żeby zobaczyć czy ma role;  --}}
                        <button onclick="location.href='{{route('admin.user.inspect',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-blue-600 hover:bg-blue-700 text-black">DETAILS</button>
                        <button onclick="location.href='{{route('admin.user.delete',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-orange-600 hover:bg-red-700 text-black">DELETE</button>
                        @if ($item->hasRole('Suspended'))
                            <button onclick="location.href='{{route('admin.user.restore',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-green-600 hover:bg-green-700 text-black">RESTORE</button>
                        @else
                            <button onclick="location.href='{{route('admin.user.suspend',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-amber-300 hover:bg-amber-500 text-black">SUSPEND</button>
                        @endif

                    </div>
                </div>
                <div class="flex ml-auto">

                </div>
            </div>
            @endforeach
        </div>
    </div>




    @guest

    @endguest
</x-layout>
