
<x-layout>

<div class="ml-60 mr-60 min-w-min">
    <div class="PageTitle">Wyślij wiadomość</div>
    <div class="ContentBox p-8">


    @if($cid)
        <form action="{{ route('send') }}" method="POST">
            @csrf
            <div class="flex my-2">
                <label class="mr-2" for="recipient">Odbiorca:</label>
                {{-- <input class="text-black rounded basis-full" type="text" id="recipient" name="recipient_mail"> --}}
                <input type="hidden" id="recipient" name="rec_id" value="{{$cid}}">

            </div>
            <div class="flex">
                <label class="mr-2" for="message">Treść:</label>
                <textarea class="text-black rounded basis-full" id="message" name="message"></textarea>
            </div>
            <div class="flex justify-center items-center mt-2"><button type="submit">Wyślij</button></div>
        </form>
    @endif
    </div>
    <div class="PageTitle">Lista Wiadomości</div>
    <ul>
        @foreach ($usersout as $usersout)
            <div class="ContentBox p-8">
            <li>
                <strong>user</strong> {{ $usersout->name }}
                <form action="{{ route('chose') }}" method="POST">
                    @csrf
                    <input type="hidden" id="rec_id" name="rec_id" value="{{$usersout->id}}">
                    <button type="submit">Send</button>
                </form>
            </li>
            </div>
        @endforeach
    </ul>
    <ul>
        @foreach ($msg as $msg)
            <div class="ContentBox p-8">
            <li>
                <strong>From:</strong> {{ $msg->sender->email }}
                <br>
                <strong>Message:</strong> {{ $msg->message }}
            </li>
            </div>
        @endforeach
    </ul>
</div>
</x-layout>
