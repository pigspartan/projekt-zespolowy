<x-layout>


    <h1>Zweryfikuj maila bastardzie</h1>

    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button>Send again</button>
    </form>


</x-layout>
