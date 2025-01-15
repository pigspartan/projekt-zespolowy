<x-layout>
    @auth


    @endauth
    @foreach ($bought as $key => $item)

        {{$item}}

    @endforeach

    @foreach ($sold as $key => $item)

        {{$item}}

    @endforeach

    <p>jak paid at jest null to znaczy że nie jest zapłacone</p>



    @guest

    @endguest
</x-layout>
