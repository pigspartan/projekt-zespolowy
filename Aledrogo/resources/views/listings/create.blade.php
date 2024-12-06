<x-layout>
    <div class="w-2/3 border-2 rounded ml-auto mr-auto mt-4">
        <h1 class="text-center text-3xl p-4 bg-blue-900">Add a new listing</h1>
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-8 flex">
            <label for="title" class="mr-2">Title&nbsp;</label><br>
            <input class="border-blue-500 border-2 rounded basis-full" type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="m-8 flex">
            <label for="content" class="mr-2">Price</label><br>
            <input class="border-blue-500 border-2 rounded mb-auto w-28 mr-4" type="number" step="0.01" name="price" value="{{ old('title') }}">
            @error('content')
            <p>{{ $message }}</p>
            @enderror
            <label for="content" class="mr-2">Description</label><br>
            <textarea class="text-black border-blue-500 border-2 rounded basis-full" rows="5" name="content">{{ old('content') }}</textarea>
            @error('content')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="m-8">
            <label class="mr-2" for="file">Photo</label>
            <input type="file" name="file" class="text-white">
            @error('file')
                <p class="text-white">{{ $message }}</p>
            @enderror
        </div>
        <button class="border-2 rounded bg-indigo-900 flex" style="padding:5px 15px 5px 15px;margin:auto; margin-bottom:20px">Add</button>
    </form>
    <p>{{ session('succes') }}</p>
    </div>

    <h1>Send a Message</h1>
    <form action="{{ route('send') }}" method="POST">
        @csrf
        <div>
            <label for="recipient">Recipient:</label>
            <input type="text" id="recipient" name="recipient_id">
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <button type="submit">Send</button>
    </form>

</x-layout>
