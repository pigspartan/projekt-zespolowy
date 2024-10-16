<x-layout>

    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">title</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="content">content</label>
            <textarea class="text-black" rows="5" name="content">{{ old('content') }}</textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="file">content</label>
            <input type="file" name="file" >
            @error('file')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button>create</button>
    </form>
    <p>{{ session('succes') }}</p>

</x-layout>
