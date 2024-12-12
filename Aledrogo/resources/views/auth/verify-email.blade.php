<x-layout>


    <p class="PageTitle">Weryfikacja Maila</p>

    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button class="DefaultButton flex m-auto">Wyślij ponownie</button>
            
    </form>


</x-layout>
