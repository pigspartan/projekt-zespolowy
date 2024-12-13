
<x-layout>
<html>

<body>
    <h1>Send a Message</h1>
    <form action="{{ route('send') }}" method="POST">
        @csrf
        <div>
            <label for="recipient">Recipient:</label>
            <input type="text" id="recipient" name="recipient_mail">
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <button type="submit">Send</button>
    </form>

    <ul>
        @foreach ($messages as $message)
            <li>
                <strong>From:</strong> {{ $message->sender->name }}
                <br>
                <strong>Message:</strong> {{ $message->message }}
            </li>
        @endforeach
    </ul>
</body>
</html>
</x-layout>
