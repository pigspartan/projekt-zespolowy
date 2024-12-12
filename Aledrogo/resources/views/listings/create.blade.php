<x-layout>
    <div class="PageTitle">Add a new listing</div>
    <div class="ContentBox">
        
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-8 flex">
            <label for="title" class="mr-2">Title&nbsp;</label><br>
            <input class="DefaultInput" type="text" name="title" value="{{ old('title') }}">
        </div>
        @error('title')
            <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        <div class="m-8 flex">
            <label for="content" class="mr-2">Price</label><br>
            <input class="DefaultInput" type="number" step="0.01" name="price" value="{{ old('title') }}">
        </div>
        
        @error('content')
            <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        <div class="m-8 flex">
            <label for="content" class="mr-2">Description</label><br>
            <textarea class="DefaultInput" rows="5" name="content">{{ old('content') }}</textarea>
        </div>
        @error('content')
            <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        <div class="m-8">
            <label class="mr-2" for="file">Photo</label>
            <input type="file" name="file" class="text-white">
        </div>
        @error('file')
        <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        <button class="DefaultButton flex" style="padding:5px 15px 5px 15px;margin:auto; margin-bottom:20px">Add</button>
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
