@component('components.todo-form')

    <form id="edit" action="/todo/{{ $todo->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <x-jet-input name="title" value="{{ old('title') ?? $todo->title }}" form="edit"></x-jet-input>
        <textarea name="description" cols="30" rows="10" form="edit">{{ $todo->description }}</textarea>
        <x-jet-button>編集</x-jet-button>
    </form>

    <form id="delete" action="/todo/{{ $todo->id }}" method="POST" onSubmit="return window.confirm('削除してよろしいですか？')">
    @csrf
    @method('delete')
        <button type="submit" form="delete">削除</button>
    </form>

@endcomponent