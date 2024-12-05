<x-layout>
    <div class="w-2/3 border-2 rounded ml-auto mr-auto mt-4">
        <p class="text-4xl m-8 text-center">Add a new listing</p>
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-8 flex">
            <label for="title" class="mr-2">Title&nbsp;</label><br>
            <input class="border-gray-950 border-2 rounded basis-full mr-6 pl-2 bg-slate-500" type="text" name="title" value="{{ old('title') }}">
            <label for="content" class="mr-2">Price</label><br>
            <input class="border-gray-950 border-2 rounded mb-auto w-28 mr-4 content-center bg-slate-500 pl-2" type="number" step="0.01" name="price" value="{{ old('title') }}">
            
        </div>
        @error('title')
            <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        @error('content')
            <p class="ml-8 text-red-500">{{ $message }}</p>
        @enderror
        <div class="m-8 flex">
            <label for="content" class="mr-2">Description</label><br>
            <textarea class="text-black border-gray-950 border-2 rounded basis-full mr-6 pl-2 bg-slate-500" rows="5" name="content">{{ old('content') }}</textarea>
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
        <button class="m-2 p-1 hover:bg-sky-800 border border-l rounded-xl flex" style="padding:5px 15px 5px 15px;margin:auto; margin-bottom:20px">Add</button>
    </form>
    <p>{{ session('succes') }}</p>
    </div>
</x-layout>
