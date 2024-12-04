<x-layout>

{{$user->name}}

@foreach($user->flaggedListings as $listing)
                    <tr>
                        <td>{{ $listing->title }}</td>
                        <td>{{ $listing->pivot->reason }}</td>
                    </tr>
                @endforeach

</x-layout>
