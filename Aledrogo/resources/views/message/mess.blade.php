
<x-layout>
    <div class="pageContent min-h-screen flex flex-col text-black dark:text-gray-300">
        <!-- Nagłówek strony -->
        <div class="pageTitle text-center py-4 text-2xl font-bold">
          Wiadomości
        </div>
      
        <!-- Główna zawartość chatu -->
        <div class="flex flex-1">
          <!-- Lista użytkowników -->
          <div class="w-1/4 bg-gray-300 dark:bg-gray-900 p-4 border rounded-l-xl">
            <h2 class="text-lg font-semibold mb-4">Użytkownicy:</h2>
            <ul class="space-y-2">
              <li class="p-2 bg-gray-400/25 dark:bg-gray-800/25 hover:bg-gray-400 dark:hover:bg-gray-700 rounded cursor-pointer ">Użytkownik 1</li>

              @for ($i = 1; $i <= 20; $i++)
              <li class="p-2 bg-gray-200 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-700 rounded cursor-pointer ">Użytkownik 4</li>
              @endfor
            </ul>
          </div>
      
          <!-- Wiadomości -->
          <div class="w-3/4 bg-gray-300 dark:bg-gray-800 p-4 flex flex-col border-y border-r rounded-r-xl">
            <div class="flex-1 overflow-y-auto">
              <div class="space-y-4">
                <!-- Przykładowa wiadomość -->
                <div class="bg-blue-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit ">
                  <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum eros sed est consectetur, a lacinia neque iaculis. Etiam at suscipit ligula. Praesent consectetur ornare odio ut finibus. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat. Quisque condimentum, metus nec rutrum luctus, neque elit laoreet est, ac ornare nibh quam at augue.

                    Integer molestie eleifend tortor id imperdiet. Duis pulvinar ligula eu pulvinar elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec feugiat mauris et sem tristique tincidunt. Praesent in rutrum quam. Mauris at justo velit. Integer lacinia cursus mauris non consectetur. Maecenas euismod tempus nisi vel faucibus. Pellentesque eget pulvinar velit, id rhoncus lorem. Aliquam erat volutpat. Nunc aliquam urna sit amet enim mollis tempor. Duis cursus,</p>
                </div>
                <div class="bg-green-400 dark:bg-gray-900/50 p-3 rounded-lg w-7/12 max-w-fit ml-auto text-right ">
                  <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum eros sed est consectetur, a lacinia neque iaculis. Etiam at suscipit ligula. Praesent consectetur ornare odio ut finibus. Praesent auctor tempor convallis. Phasellus eu leo neque. Donec at turpis vitae sem ullamcorper placerat. Quisque condimentum, metus nec rutrum luctus, neque elit laoreet est, ac ornare nibh quam at augue.

                    Integer molestie eleifend tortor id </p>
                </div>
                <div class="bg-green-400 dark:bg-gray-700/50 p-3 rounded-lg w-7/12 max-w-fit ">
                  <p class="text-sm">Też dobrze, dzięki!</p>
                </div>
              </div>
            </div>
            <!-- Pole do wprowadzania tekstu -->
            <div class="mt-4">
              <input
                type="text"
                placeholder="Napisz wiadomość..."
                class="w-full p-3 defaultInput"
              />
            </div>
          </div>
        </div>
      </div>
</x-layout>




{{-- <div class="ml-60 mr-60 min-w-min">
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
</div> --}}