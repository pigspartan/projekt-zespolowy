<x-layout>
    <div class="ml-60 mr-60 min-w-min">
        <h1 class="text-center text-3xl p-4 bg-sky-700">{{$item->title}}</h1>
        <div class="flex flex-wrap">
            <img class="max-w-80" src="{{asset('storage/'.$item->path)}}" alt="produkt">
            <div class="flex flex-col flex-grow">
                <p class="p-4 text-xl">Opis: {{$item->content}}</p>
                <a href="#" class="pl-4">Sprzedający: {{$item->user->name}}</a>
                <div class="p-2 flex justify-center">
                    <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded">Zakup</button> <button class="m-4 p-1 bg-amber-300 text-black border-emerald-600 border-2 rounded">Wyślij wiadomość</button>
                </div>
                <p class="pt-2 text-right text-sm">Ogłoszenie utworzono: {{$item->created_at}}</p>
                <p class="text-right text-sm">Ostatnia aktualizacja: {{$item->updated_at}}</p>
            </div>
        </div>
    </div>
</x-layout>
