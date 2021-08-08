<x-input-form>

    <form id="edit" action="/todo/{{ $todo->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-5">
            <x-jet-input name="title" value="{{ $todo->title }}" readonly="{{ $todo->entry_id }}" ></x-jet-input>
        </div>   
        @php 
            $datetime_start = Illuminate\Support\Carbon::parse($todo->time_to_start)->format('Y-m-d\TH:i');
            $datetime_end = Illuminate\Support\Carbon::parse($todo->time_to_end)->format('Y-m-d\TH:i');
        @endphp 
        <div x-data="{time_to_end: '{{ $datetime_end }}' }" class="mb-5 flex items-center">
            <input name="time_to_start" type="datetime-local" step="3600" value="{{ $datetime_start }}" :max="time_to_end" {{$todo->entry_id ? 'readonly' : ''}} />
            <div class="{{ $todo->entry_id ? 'hidden' : '' }}">
                <span>~</span>
                <input name="time_to_end" type="datetime-local" step="3600" x-model="time_to_end" {{$todo->entry_id ? 'readonly' : ''}} />
            </div>
        </div>     
        <div class="mb-5">      
            <textarea 
                name="description" 
                class="w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md"
                rows="10"
                {{$todo->entry_id ? 'readonly' : ''}}>{{ $todo->description }}</textarea>
        </div>  
        <div class="mb-5 text-sm flex items-center">
            <input type="checkbox" name="is_done" {{ $todo->is_done ? 'checked' : '' }}>
            <span class="pl-3">完了済み</span>
        </div>    
        <div class="mb-5">
            <x-jet-button form="edit">編集</x-jet-button>
        </div>
    </form>

    <form id="delete" action="/todo/{{ $todo->id }}" method="POST" onSubmit="return window.confirm('削除してよろしいですか？')">
    @csrf
    @method('delete')
        <x-jet-danger-button type="submit" form="delete">削除</x-jet-danger-button>
    </form>

</x-input-form>