<x-layout>
    <div class="pageTitle">Dodaj ogłoszenie</div>
    <div class="contentBox">
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-8 flex place-content-between">
            <div class="basis-full flex">
                <label for="title" class="defaultLabel">Nazwa&nbsp;</label><br>
                <input class="defaultInput mr-12" type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="flex">
                <label for="content" class="defaultLabel">Cena</label><br>
                <input class="defaultInput" type="number" step="0.01" name="price" value="{{ old('title') }}">
            </div>
        </div>
        @error('title')
            <p class="warning">{{ $message }}</p>
        @enderror
        @error('content')
            <p class="warning">{{ $message }}</p>
        @enderror
        <div class="m-8 flex">
            <label for="content" class="defaultLabel">Opis</label><br>
            <textarea class="defaultInput ml-8" rows="5" name="content">{{ old('content') }}</textarea>
        </div>
        @error('content')
            <p class="warning">{{ $message }}</p>
        @enderror
        <div class="m-8">
            <label class="defaultLabel" for="file">Zdjęcie</label>
            <input type="file" name="file" class="dark:text-white">
        </div>
        @error('file')
        <p class="warning">{{ $message }}</p>
        @enderror
        <div class="centerDiv pb-4">
            <button class="defaultButton">Dodaj</button>
        </div>
    </form>
    <p>{{ session('success') }}</p>
    </div>

</x-layout>
