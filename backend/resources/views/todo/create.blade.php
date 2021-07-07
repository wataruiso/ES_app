<x-input-form>
    <form action="/todo" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-5">
            <x-jet-input name="title" value="{{ old('title') }}"></x-jet-input>
        </div>
        <div class="mb-5">
            <input name="deadline" type="datetime-local" step="3600" value="{{ date('Y-m-d') . 'T00:00' }}" />
        </div>
        <div class="mb-5">
            <textarea 
                name="description" 
                class="w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md"
                rows="10">{{ old('description') }}</textarea>
        </div>
        <div>
            <x-jet-button>作成</x-jet-button>
        </div>
    </form>
</x-input-form>