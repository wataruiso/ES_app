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
                <form id="edit" action="/todo/{{ $todo->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <x-jet-input name="title" value="{{ $todo->title }}" form="edit"></x-jet-input>
                    <textarea name="description" cols="30" rows="10" form="edit">{{ $todo->description }}</textarea>
                    <x-jet-button>編集</x-jet-button>
                </form>

                <form id="delete" action="/todo/{{ $todo->id }}" method="POST">
                @csrf
                @method('delete')
                    <button type="submit" form="delete">削除</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>