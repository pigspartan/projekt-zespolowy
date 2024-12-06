
<html>
<head>
    <title>Message List</title>
</head>
<body>
    <h1>Your Messages</h1>
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
