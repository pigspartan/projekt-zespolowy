<x-layout>
    <div class="listingDetails">
        <h1 class="pageTitle">{{$item->title}}</h1>
        <div class="flex flex-wrap">
            <img class="roundedImg" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-grow mr">
                <p class="p-4 text-xl">Opis: {{$item->content}}</p>
                <a href="{{route('userListings',['id' => $item->user->id])}}" class="pl-4">Sprzedający: {{$item->user->name}}</a>
                <p class="text-2xl m-auto mr-4">Cena: <span class="goldText">{{$item->price}}</span> zł</p>
                <div class="p-2 flex justify-center">
                    <button class="m-4 p-1 bg-amber-300 text-black border-amber-400 border-2 rounded" id='kup'>Zakup</button>
                    <button class="m-4 p-1 bg-amber-300 text-black border-amber-400 border-2 rounded"id="messageButton">Skontaktuj się</button>
                    {{-- bool canFlag: true->może flagować; false->nie może flagować; --}}
                    <button {{!$canFlag ? 'disabled' : ''}} class="m-4 p-1 {{!$canFlag ? 'bg-gray-400' : 'bg-red-500'}} text-black border-amber-600 border-2 rounded" id="reportButton">{{!$canFlag ? "Zgłosiłeś ogłoszenie" : "Zgłoś ogłoszenie"}}</button>
                    {{-- <button onclick="location.href='{{route('listing.flag',['id' => $item->id])}}'" class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded" id='flag'>Oflaguj</button> --}}
                </div>
                <div id="flagForm" class="bg-gray-400/25 dark:bg-slate-700 rounded mx-auto" hidden>
                    <form class="pl-4 flex flex-row justify-center items-center" action="{{ route('listing.flag', $item->id) }}" method="POST">
                        @csrf
                        <label for="reason">Powód zgłoszenia: </label>
                        <textarea class="defaultInput dark:hover:bg-gray-600/50 m-2 text-black" name="message" id="message" required></textarea>
                        <button class="m-4 p-1 bg-red-500 text-black border-amber-600 border-2 rounded" type="submit">Potwierdź zgłoszenie</button>
                    </form>
                </div>
                <div id="messageForm" class="bg-gray-400/25 dark:bg-slate-700 rounded mx-auto" hidden>
                    <form class="pl-4 flex flex-row justify-center items-center" action="{{ route('send') }}" method="POST">
                        @csrf
                        <input type="hidden" id="rec_id" name="rec_id" value="{{$item->user->id}}">
                        <label for="message">Wiadomość: </label>
                        <textarea class="defaultInput dark:hover:bg-gray-600/50 m-2 text-black" name="message" id="message" rows="3" required></textarea>
                        <button class="m-4 p-1 bg-amber-500 text-black border-amber-600 border-2 rounded" type="submit">Wyślij wiadomość</button>
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
        {{-- <div class="p-4">
            <form action="{{ route('send') }}" method="POST">
                @csrf
                <input type="hidden" id="rec_id" name="rec_id" value="{{$item->user->id}}">
                <div>
                    <h1><label for="message">Skontaktuj się</label></h1>
                    <textarea class="defaultInput hover:bg-gray-200" id="message" name="message"></textarea>
                </div>
                <button class="p-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-xl" type="submit">Send</button>
            </form>
        </div> --}}
    </div>

    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    <script>
        document.getElementById('reportButton').addEventListener('click', function (){
            if(!document.getElementById('messageForm').hasAttribute('hidden')){
                document.getElementById('messageForm').setAttribute('hidden', true);
            }
            if(document.getElementById('flagForm').hasAttribute('hidden')){
                document.getElementById('flagForm').removeAttribute('hidden');
            }
            else{
                document.getElementById('flagForm').setAttribute('hidden', true);
            }
        });
        document.getElementById('messageButton').addEventListener('click', function (){
            if(!document.getElementById('flagForm').hasAttribute('hidden')){
                document.getElementById('flagForm').setAttribute('hidden', true);
            }
            if(document.getElementById('messageForm').hasAttribute('hidden')){
                document.getElementById('messageForm').removeAttribute('hidden');
            }
            else{
                document.getElementById('messageForm').setAttribute('hidden', true);
            }
        });
        document.getElementById('kup').addEventListener('click', function() {
            window.location.href = "{{ route('paypal.createPayment') }}?Id=" + {{$item->id}};
        });
    </script>
</x-layout>
