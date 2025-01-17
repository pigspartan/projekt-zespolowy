<x-layout>
    @auth


    @endauth
    <div class="pageContent">
    @if(!$bought->count() > 0 && !$sold->count() > 0)
    <div class="pageTitle">Brak aktywnych transakcji</div>
    @endif


    @if ($bought->count() > 0)
        <div class="pageTitle">Twoje transakcje</div>
        @foreach ($bought as $key => $item)
            <div class="listing bg-gray-400 dark:bg-gray-800">
                <img class="w-32 h-fit mt-auto mb-auto rounded" src="{{asset('storage/'.$item->listing->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->listing->title}}</p>
                    <p>Description: {{$item->listing->content}}</p>
                    <p>Seller:<a href='{{route('userListings',['id' => $item->listing->user->id])}}'> {{$item->listing->user->name}}</a></p>
                </div>
                {{-- <p>{{  $item->id}}  {{ $item->status}}<p> --}}
                    <div class="flex ml-auto">
                        <div class="mt-auto mr-2 mb-auto flex">
                            <p class="text-2xl m-auto mr-4">Cena: <span class="goldText">{{$item->listing->price}}</span> zł</p>

                @if ($item->listing->status == 'reserved' && $item->payment_id && $item->status == 'CREATED')
                    {{-- <a href="{{ route('paypal.resumePayment', [$item->listing->id, $item->id]) }}" class="btn btn-primary">
                        Resume Payment
                    </a> --}}
                    <button onclick="location.href='{{ route('paypal.resumePayment', [$item->listing->id, $item->id]) }}'"
                        class="border-2 hover:border-black rounded-3xl px-2 h-12 bg-amber-300 hover:bg-amber-500 text-black transition">Kontynuuj zakup</button>
                @endif
                @if ($item->listing->status == 'available' && $item->status == 'CREATED')
                    <button class="border-2 rounded-3xl px-2 h-12 bg-red-500 text-black transition">Cancelled</button>
                @endif
                @if ($item->status == 'CANCELLED')
                    <button class="border-2 rounded-3xl px-2 h-12 bg-red-500 text-black transition">Cancelled</button>
                @endif
                @if ($item->status == 'COMPLETED')
                    <button class="border-2 rounded-3xl px-2 h-12 bg-green-500 text-black transition">Completed</button>
                @endif
                </div>
            </div>
            </div>
        @endforeach
        @endif



        @if($sold->count() > 0)
            <div class="pageTitle">Transakcje twoich ogłoszeń</div>
            @foreach ($sold as $key => $item)
            <div class="listing bg-gray-400 dark:bg-gray-800">
                <img class="w-32 h-fit mt-auto mb-auto rounded" src="{{asset('storage/'.$item->listing->path)}}" alt="produkt">
                <div class="flex flex-col flex-wrap m-6 min-w-32">
                    <p class="text-xl font-bold">{{$item->listing->title}}</p>
                    <p>Description: {{$item->listing->content}}</p>
                    <p>Seller:<a href='{{route('userListings',['id' => $item->listing->user->id])}}'> {{$item->listing->user->name}}</a></p>
                </div>
                {{-- <p>{{  $item->id}}  {{ $item->status}}<p> --}}
                    <div class="flex ml-auto">
                        <div class="mt-auto mr-2 mb-auto flex">
                            <p class="text-2xl m-auto mr-4">Cena: <span class="goldText">{{$item->listing->price}}</span> zł</p>

                @if ($item->listing->status == 'reserved' && $item->payment_id && $item->status == 'CREATED')
                    {{-- <a href="{{ route('paypal.resumePayment', [$item->listing->id, $item->id]) }}" class="btn btn-primary">
                        Resume Payment
                    </a> --}}
                    <button class="border-2 rounded-3xl px-2 h-12 bg-amber-300 text-black transition">Zarezerwowane</button>
                @endif
                @if ($item->listing->status == 'available' && $item->status == 'CREATED')
                    <button class="border-2 hover:border-black rounded-3xl px-2 h-12 bg-red-500 text-black transition">Cancelled</button>
                @endif
                @if ($item->status == 'CANCELLED')
                    <button class="border-2 hover:border-black rounded-3xl px-2 h-12 bg-red-500 text-black transition">Cancelled</button>
                @endif
                @if ($item->status == 'COMPLETED')
                    <button class="border-2 hover:border-black rounded-3xl px-2 h-12 bg-green-500 text-black transition">Completed</button>
                @endif
                </div>
            </div>
            </div>
            @endforeach
        @endif
    </div>


    @guest

    @endguest
</x-layout>
