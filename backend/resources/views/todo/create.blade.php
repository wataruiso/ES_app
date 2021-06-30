<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
                <form action="/todo" method="POST" enctype="multipart/form-data">
                @csrf
                    <x-jet-input name="title"></x-jet-input>
                    <textarea name="description" cols="30" rows="10"></textarea>
                    <x-jet-button>作成</x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>