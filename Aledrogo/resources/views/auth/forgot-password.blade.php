<x-layout>
    {{-- pod 'status' jest info zwrotne serwera --}}
    <div class="pageContent">
        <div class="pageTitle">
            Przypomnij hasło
        </div>
        <div class="contentBox">
            <form action="{{route('password.request')}}" method="POST">
                @csrf
                <div class="formElement">
                    <label class="defaultLabel" for="email">Email</label>
                    <input class="defaultInput" type="email" name="email">
                </div>
                <div class="centerDiv mt-2 mb-6">
                    <button class="defaultButton">Wyślij</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>

