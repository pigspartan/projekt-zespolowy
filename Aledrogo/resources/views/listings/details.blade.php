<x-layout>
    <div class="ml-60 mr-60 min-w-min">
        <h1 class="text-center text-3xl p-4 bg-sky-700">{{$item->title}}</h1>
        <div class="flex flex-wrap">
            <img class="max-w-80 h-min" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-grow mr">
                <p class="p-4 text-xl">Opis: {{$item->content}}</p>
                <a href="{{route('userListings',['id' => $item->user->id])}}" class="pl-4">Sprzedający: {{$item->user->name}}</a>
                <p class="text-2xl m-auto mr-4">Price: <span class="text-amber-300">{{$item->price}}</span> zł</p>
                <div class="p-2 flex justify-center">
                    <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='kup'>Zakup</button>
                    <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded">Wyślij wiadomość</button>
                    {{-- bool canFlag: true->może flagować; false->nie może flagować; --}}
<<<<<<< HEAD
                    <button class="m-4 p-1 bg-red-500 text-black border-amber-600 border-2 rounded" id="reportButton">Zgłoś ogłoszenie</button>
=======
                    <button {{!$canFlag ? 'disabled' : ''}} class="m-4 p-1 {{!$canFlag ? 'bg-gray-400' : 'bg-red-500'}} text-black border-amber-600 border-2 rounded" id="reportButton">{{!$canFlag ? "Zgłosiłeś ogłoszenie" : "Zgłoś ogłoszenie"}}</button>
                    {{-- <button onclick="location.href='{{route('listing.flag',['id' => $item->id])}}'" class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='flag'>Oflaguj</button> --}}
>>>>>>> f50d83e2448f558b319b1c08095317fc793e11cb
                </div>
                <div id="flagForm" hidden>
                    <form class="pl-4 flex flex-row justify-center items-center" action="{{ route('listing.flag', $item->id) }}" method="POST">
                        @csrf
                        <label for="reason">Powód zgłoszenia: </label>
                        <textarea class="m-2 text-black" name="reason" id="reason" required></textarea>
                        <button class="m-4 p-1 bg-red-500 text-black border-amber-600 border-2 rounded" type="submit">Potwierdź zgłoszenie</button>
                    </form>
                </div>
                <p class="pt-2 text-right text-sm">Ogłoszenie utworzono: {{$item->created_at}}</p>
                <p class="text-right text-sm">Ostatnia aktualizacja: {{$item->updated_at}}</p>

            </div>
        </div>
    </div>
    <div id="reports" class="flex flex-col">
        @role('Admin')
        @if($item->flaggedByUsers->isEmpty())
            <p class="text-center">Ogłoszenie nie zostało zgłoszone</p>
        @else
            <p class="text-center mx-auto">Lista zgłoszeń</p>
            <table class="border-2 mx-auto">
                <thead>
                <tr>
                    <th class="border-2 p-1">Użytkownik</th>
                    <th class="border-2 p-1">Powód</th>
                    <th class="border-2 p-1">Data zgłoszenia</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item->flaggedByUsers as $user)
                    <tr>
                        <td class="border-2 p-1">{{ $user->name }}</td>
                        <td class="border-2 p-1">{{ $user->pivot->reason }}</td>
                        <td class="border-2 p-1">{{ $user->pivot->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        @endrole
    </div>
    <script>
        document.getElementById('reportButton').addEventListener('click', function (){
            document.getElementById('flagForm').removeAttribute('hidden');
        });

        document.getElementById('kup').addEventListener('click', function() {
            window.location.href = "{{ route('paypal.createPayment') }}?Id=" + {{$item->id}};
        });
    </script>
</x-layout>
