<x-layout>
    @auth
    @endauth
    <div class="pageContent">
        <h1 class="pageTitle">List of Your listed listings</h1>
        @foreach ($items as $key => $item)
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
                    <button onclick="location.href='{{route('itemDetails',['id' => $item->getKey()])}}'" class="border-2 hover:border-black rounded-3xl w-20 h-12 bg-amber-300 hover:bg-amber-500 text-black">Szczegóły</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @guest
    @endguest
</x-layout>
