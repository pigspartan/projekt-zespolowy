<x-layout>
    <p class="pageTitle">Wysłano maila z weryfikacją konta</p>
    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button class="defaultButton flex m-auto">Wyślij ponownie</button>
    </form>
</x-layout>
