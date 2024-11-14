<x-layout>

    <div class="border-2" style="align-content: center; width:50%; min-width:max-content; margin:auto; margin-top:20px">
        <h1 class="text-center text-3xl p-4 bg-blue-900">Add a new listing</h1>
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-8">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="m-8 flex">
            <label for="content" style="margin-right:10px;">Description</label>
            <textarea class="text-black" rows="5" name="content">{{ old('content') }}</textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="m-8">
            <label for="file">Photo</label>
            <input type="file" name="file" >
            @error('file')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="m-8 flex">
            <label for="content" style="margin-right:10px;">price</label>
            <input type="number "step="0.01" name="price" value="{{ old('title') }}">
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button class="border-2 rounded bg-indigo-900 flex" style="padding:5px 15px 5px 15px;margin:auto; margin-bottom:20px">Add</button>
    </form>
    <p>{{ session('succes') }}</p>
    </div>

</x-layout>
