<x-input-form>

    <form id="edit" action="/todo/{{ $todo->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-5">
            <x-jet-input name="title" value="{{ $todo->title }}"></x-jet-input>
        </div>      
        <div class="mb-5">     
            <input name="deadline" type="datetime-local" step="3600" value="{{ date('Y-m-d', strtotime($todo->deadline)) . 'T00:00' }}" /> 
        </div>      
        <div class="mb-5">      
            <textarea 
                name="description" 
                class="w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md"
                rows="10">{{ $todo->description }}</textarea>
        </div>  
        <div class="mb-5 text-sm">
            <input type="checkbox" name="is_done" checked="{{ $todo->is_done ? 'checked' : '' }}">完了済み
        </div>    
        <div>
            <x-jet-button form="edit">編集</x-jet-button>
        </div>
    </form>

    <form id="delete" action="/todo/{{ $todo->id }}" method="POST" onSubmit="return window.confirm('削除してよろしいですか？')">
    @csrf
    @method('delete')
        <button type="submit" form="delete">削除</button>
    </form>

</x-input-form>