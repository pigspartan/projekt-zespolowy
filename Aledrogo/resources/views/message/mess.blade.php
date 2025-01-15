
<x-layout>

<div class="ml-60 mr-60 min-w-min">
    <div class="PageTitle">Wyślij wiadomość</div>
    <div class="ContentBox p-8">
    <form action="{{ route('send') }}" method="POST">
        @csrf
        <div class="flex my-2">
            <label class="mr-2" for="recipient">Odbiorca:</label>
            <input class="text-black rounded basis-full" type="text" id="recipient" name="recipient_mail">
        </div>
        <div class="flex">
            <label class="mr-2" for="message">Treść:</label>
            <textarea class="text-black rounded basis-full" id="message" name="message"></textarea>
        </div>
        <div class="flex justify-center items-center mt-2"><button type="submit">Wyślij</button></div>
    </form>
    </div>
    <div class="PageTitle">Lista Wiadomości</div>
    <ul>
        @foreach ($messages as $message)
            <div class="ContentBox p-8">
            <li>
                <strong>From:</strong> {{ $message->sender->email }}
                <br>
                <strong>Message:</strong> {{ $message->message }}
            </li>
            </div>
        @endforeach
    </ul>
</div>
</x-layout>
