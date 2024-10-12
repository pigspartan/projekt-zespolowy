<x-layout>

@foreach ($listings as $item)
<h2>{{$item->title}}</h2>
<p>{{$item->content}}</p>
<h3>{{$item->user->name}}</h3>
@endforeach

</x-layout>

