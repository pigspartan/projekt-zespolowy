<x-layout>
    @vite(['resources/js/dogscript.js'])
    @auth
    @endauth
    <div class="flex flex-row">
        <div class="ml-40 mr-4 basis-1/2">
            <h1 class="pageTitle">Oflagowane ogłoszenia</h1>
            @foreach ($listings as $key => $item)
            <div class="listing {{$key % 2 == 0 ? "bg-gray-400 dark:bg-gray-800" : "bg-gray-300 dark:bg-slate-800"}}">
                <img class="w-32 h-fit mt-auto mb-auto" src="{{asset('storage/'.$item->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->title}}</p>
                    <p>Description: {{$item->content}}</p>
                    <p>Seller:<a href='{{route('userListings',['id' => $item->user->id])}}'> {{$item->user->name}}</a></p>
                    <p>Liczba flag: {{$item->timesFlagged}}</p>
                </div>
                <div class="flex flex-col ml-auto">
                    <button onclick="location.href='{{route('delete',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-1 bg-orange-600 hover:bg-red-700 text-black">DELETE</button>
                    <button onclick="location.href='{{route('listing.unflag',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-1 bg-green-600 hover:bg-green-700 text-black">UNFLAG</button>
                    <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 mt-auto mr-2 mb-auto bg-amber-300 hover:bg-amber-500 text-black">DETAILS</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mr-40 ml-4 basis-1/2">
            <h1 class="pageTitle">Użytkownicy</h1>
            @foreach ($users as $key => $item)
            <div class="listing {{$key % 2 == 0 ? "bg-gray-400 dark:bg-gray-800" : "bg-gray-300 dark:bg-slate-800"}}">
                <div>
                    <p class="text-xl font-bold">{{$item->name}}</p>
                    <p>Email: {{$item->email}}</p>
                    <div>
                        Rola:
                            @foreach($item->roles as $rKey => $role)
                                {{$role->name}}
                            @endforeach
                    </div>
                </div>
                <div class="ml-auto my-auto">
                    {{-- user->hasRole('nazwaRoli') żeby zobaczyć czy ma role;  --}}
                    <button onclick="location.href='{{route('userListings',['id' => $item->id])}}'" class="border-2 border-black rounded-xl w-20 h-12 mt-auto mr-2 mb-auto bg-blue-500 hover:bg-blue-700 text-black">Szczegóły</button>
                    <button onclick="location.href='{{route('admin.user.delete',['id' => $item->getKey()])}}'" class="border-2 border-black rounded-xl w-20 h-12 mt-auto mr-2 mb-auto bg-blue-500 hover:bg-blue-700 text-black">Usuń</button>
                    @if ($item->hasRole('Suspended'))
                        <button onclick="location.href='{{route('admin.user.restore',['id' => $item->getKey()])}}'" class="border-2 border-black rounded-xl w-20 h-12 mt-auto mr-2 mb-auto bg-blue-500 hover:bg-blue-700 text-black">Odblokuj</button>
                    @else
                        <button onclick="location.href='{{route('admin.user.suspend',['id' => $item->getKey()])}}'" class="border-2 border-black rounded-xl w-20 h-12 mt-auto mr-2 mb-auto bg-blue-500 hover:bg-blue-700 text-black">Zablokuj</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @guest
    @endguest
</x-layout>
