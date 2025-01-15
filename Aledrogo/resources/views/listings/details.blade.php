<x-layout>
    <div class="ml-60 mr-60 bg-slate-800 p-16 pt-2 rounded-xl min-w-min">
        <h1 class="text-center max-w-max mx-auto text-3xl py-4 px-40 my-4 rounded-xl shadow-lg bg-sky-700">{{$item->title}}</h1>
        <div class="flex flex-wrap">
            <img class="max-w-80 h-min rounded" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-grow mr">
                <p class="p-4 text-xl">Opis: {{$item->content}}</p>
                <a href="{{route('userListings',['id' => $item->user->id])}}" class="pl-4">Sprzedający: {{$item->user->name}}</a>
                <p class="text-2xl m-auto mr-4">Cena: <span class="text-amber-300">{{$item->price}}</span> zł</p>
                <div class="p-2 flex justify-center">
                    <button class="m-4 p-1 bg-amber-300 text-black border-amber-400 border-2 rounded" id='kup'>Zakup</button>
                    <button onclick="location.href='{{route('message')}}'" class="m-4 p-1 bg-amber-300 text-black border-amber-400 border-2 rounded">Wyślij wiadomość</button>
                    {{-- bool canFlag: true->może flagować; false->nie może flagować; --}}
                    <button {{!$canFlag ? 'disabled' : ''}} class="m-4 p-1 {{!$canFlag ? 'bg-gray-400' : 'bg-red-500'}} text-black border-amber-600 border-2 rounded" id="reportButton">{{!$canFlag ? "Zgłosiłeś ogłoszenie" : "Zgłoś ogłoszenie"}}</button>
                    {{-- <button onclick="location.href='{{route('listing.flag',['id' => $item->id])}}'" class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='flag'>Oflaguj</button> --}}
                </div>
                <div id="flagForm" class="bg-slate-700 rounded mx-auto" hidden>
                    <form class="pl-4 flex flex-row justify-center items-center" action="{{ route('listing.flag', $item->id) }}" method="POST">
                        @csrf
                        <label for="reason">Powód zgłoszenia: </label>
                        <textarea class="m-2 text-black rounded" name="reason" id="reason" required></textarea>
                        <button class="m-4 p-1 bg-red-500 text-black border-amber-600 border-2 rounded" type="submit">Potwierdź zgłoszenie</button>
                    </form>
                </div>
                <p class="pt-2 text-right text-sm">Ogłoszenie utworzono: {{$item->created_at}}</p>
                <p class="text-right text-sm">Ostatnia aktualizacja: {{$item->updated_at}}</p>

            </div>
        </div>
    </div>
    <div id="reports" class="mt-4 flex flex-col">
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
        <!--
        <form action="{{ route('send') }}" method="POST">
            @csrf
            <div>
                <input type="hidden" id="recipient" name="recipient_mail" value="{{$item->user->email}}">
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message"></textarea>
            </div>
            <button type="submit">Send</button>
        </form>
        -->
    </div>

    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    <script>
        document.getElementById('reportButton').addEventListener('click', function (){
            document.getElementById('flagForm').removeAttribute('hidden');
        });
        document.getElementById('kup').addEventListener('click', function() {
            window.location.href = "{{ route('paypal.createPayment') }}?Id=" + {{$item->id}};
        });
    </script>
</x-layout>
