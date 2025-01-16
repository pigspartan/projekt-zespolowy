
<x-layout>
    <div class="pageContent min-h-screen flex flex-col text-black dark:text-gray-300">
        <!-- Nagłówek strony -->
        <div class="pageTitle text-center py-4 text-2xl font-bold">
            Wiadomości
        </div>

        <!-- Główna zawartość chatu -->
        <div class="flex flex-1 max-h-[calc(100vh-12rem)]">
            <!-- Lista użytkowników -->
            <div class="w-1/4 bg-gray-300 dark:bg-gray-900 p-4 border rounded-l-xl overflow-y-auto max-h-[calc(100vh-8rem)]">
                <h2 class="text-lg font-semibold mb-4">Użytkownicy:</h2>
                <ul class="space-y-2">
                    {{-- <li class="p-2 bg-gray-400/25 dark:bg-gray-800/25 hover:bg-gray-400 dark:hover:bg-gray-700 rounded cursor-pointer">Użytkownik 1</li> --}}

                    <ul class="space-y-2">
                        @foreach ($usersout as $user)
                            <li 
                                class="transition p-2 bg-gray-200 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-700 rounded cursor-pointer"
                                onclick="submitForm('{{ $user->id }}')"
                            >
                                {{ $user->name }}
                            </li>
                        @endforeach
                    </ul>
                    
                    <!-- Formularz ukryty -->
                    <form id="userForm" action="{{ route('chose') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" id="sender" name="sender" value="">
                    </form>
                    
                    <script>
                        function submitForm(userId) {
                            // Ustaw wartość pola ukrytego
                            document.getElementById('sender').value = userId;
                            // Wyślij formularz
                            document.getElementById('userForm').submit();
                        }
                    </script>
                </ul>
            </div>

            <!-- Wiadomości -->
            <div class="w-3/4 bg-gray-300 dark:bg-gray-800 p-4 flex flex-col border-y border-r rounded-r-xl">
                <div class="flex-1 overflow-y-auto max-h-[calc(100vh-8rem)]">
                    <div class="space-y-4">
                        <!-- Przykładowa wiadomość -->
                        {{-- <div class="bg-blue-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit">
                            <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum eros sed est consectetur, a lacinia neque iaculis. Etiam at suscipit ligula. Praesent consectetur ornare odio ut finibus. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat. Quisque condimentum, metus nec rutrum luctus, neque elit laoreet est, ac ornare nibh quam at augue. Integer molestie eleifend tortor id imperdiet. Duis pulvinar ligula eu pulvinar elementum.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum eros sed est consectetur, a lacinia neque iaculis. Etiam at suscipit ligula. Praesent consectetur ornare odio ut finibus. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat. Quisque condimentum, metus nec rutrum luctus, neque elit laoreet est, ac ornare nibh quam at augue. Integer molestie eleifend tortor id imperdiet. Duis pulvinar ligula eu pulvinar elementum.</p>
                        </div> --}}
                        @foreach ($msg as $msg)
                        @if($msg->sender_id == Auth::user()->id)
                        <div class="bg-green-400 dark:bg-gray-900/50 p-3 rounded-lg w-7/12 max-w-fit ml-auto text-right">
                            <p class="text-sm">{{ $msg->message }}</p>
                        </div>
                        @else
                        <div class="bg-blue-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit">
                            <p class="text-sm">{{ $msg->message }}</p>
                        </div>
                        @endif
                        @endforeach
                        {{-- <div class="bg-green-400 dark:bg-gray-900/50 p-3 rounded-lg w-7/12 max-w-fit ml-auto text-right">
                            <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum eros sed est consectetur, a lacinia neque iaculis. Etiam at suscipit ligula. Praesent consectetur ornare odio ut finibus. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat.</p>
                        </div>
                        <div class="bg-blue-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit">
                            <p class="text-sm">Też dobrze, dzięki!</p>
                        </div>
                        @for($i = 1; $i <= 20; $i++)
                            @if ($i % 2 == 0)
                            <div class="bg-blue-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit">
                                <p class="text-sm">Też dobrze, dzięki!</p>
                            </div>
                            @endif
                            @if ($i % 2 == 1)
                            <div class="bg-green-400 dark:bg-gray-900/50 p-3 rounded-lg w-7/12 max-w-fit ml-auto text-right">
                                <p class="text-sm">ei. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat.</p>
                            </div>
                            @endif
                        @endfor --}}
                    </div>
                </div>
                <!-- Pole do wprowadzania tekstu -->
                @if($cid)
                <form action="{{ route('send') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="flex items-center gap-2">
                        <input type="hidden" id="recipient" name="rec_id" value="{{ $cid }}">
                        <input 
                            id="message" 
                            name="message" 
                            type="textarea" 
                            placeholder="Napisz wiadomość..." 
                            class="flex-1 p-3 border rounded-l-lg defaultInput">
                        <button 
                            type="submit" 
                            class="px-4 py-3 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition">
                            Wyślij
                        </button>
                    </div>
                </form>
                
                @endif
            </div>
        </div>
    </div>
</x-layout>





{{-- <div class="ml-60 mr-60 min-w-min">
    <div class="PageTitle">Wyślij wiadomość</div>
    <div class="ContentBox p-8">


    @if($cid)
        <form action="{{ route('send') }}" method="POST">
            @csrf
            <div class="flex my-2">
                <label class="mr-2" for="recipient">Odbiorca:</label>
                {{-- <input class="text-black rounded basis-full" type="text" id="recipient" name="recipient_mail"> --}}
                {{-- <input type="hidden" id="recipient" name="rec_id" value="{{$cid}}">
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
                    <input type="hidden" id="sender" name="sender" value="{{$usersout->id}}">
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
</div> --}}