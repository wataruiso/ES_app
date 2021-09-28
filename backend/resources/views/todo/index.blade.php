<x-page-container title="やることリスト">
    <div class="border-b-2 py-3 px-4" x-data="{editable: false}">
        <a href="#" @click.prevent="editable = true" x-show="!editable" class="block font-bold text-xl">タスクを追加</a>
        <div x-show="editable" style="display: none;" class="pt-3">
            @livewire('create-todo')
        </div>
    </div>
    @if (isset($todos) && count($todos))
    @foreach ($todos as $todo)
        @livewire(
                'edit-todo', 
                [
                    'todo' => $todo,
                ], 
            )    
        @endforeach
    @else
    <div class="py-20 px-4 text-center">
        <h1 class="text-xl">タスクがありません</h1>
    </div>
    @endif
</x-page-container>