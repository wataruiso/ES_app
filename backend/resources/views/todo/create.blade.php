@component('components.todo-form')
    <form action="/todo" method="POST" enctype="multipart/form-data">
    @csrf
        <x-jet-input name="title" value="{{ old('title') }}"></x-jet-input>
        <textarea name="description" cols="30" rows="10">{{ old('description') }}</textarea>
        <x-jet-button>作成</x-jet-button>
    </form>
@endcomponent