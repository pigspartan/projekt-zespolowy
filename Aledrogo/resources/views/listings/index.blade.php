<x-layout>

@foreach ($listings as $item)
<h2>{{$item->title}}</h2>
<p>{{$item->content}}</p>
<h3>{{$item->user->name}}</h3>
<img src={{URL::asset('storage/app/public/img/'.$item->path)}} alt="Italian Trulli">


@endforeach

</x-layout>

