<x-layout>
    @auth


    @endauth
    @foreach ($bought as $key => $item)
        <p>{{  $item->id}}  {{ $item->status}}<p>
            @if ($item->listing->status == 'reserved' && $item->payment_id && $item->status == 'CREATED')
                <a href="{{ route('paypal.resumePayment', [$item->listing->id, $item->id]) }}" class="btn btn-primary">
                    Resume Payment
                </a>
            @endif
            @if ($item->listing->status == 'available' && $item->status == 'CREATED')
                Cancelled
            @endif
            @if ($item->status == 'CANCELLED')
                Cancelled
            @endif
            @if ($item->status == 'COMPLETED')
                Completed
            @endif
    @endforeach

    @foreach ($sold as $key => $item)
        <p>{{ $item->listing->title }}</p>
    @endforeach

    <p>jak paid at jest null to znaczy że nie jest zapłacone | statusy listingu available, reserved (zaczął kupować, ale nie skończył), sold (sprzedane)</p>



    @guest

    @endguest
</x-layout>
