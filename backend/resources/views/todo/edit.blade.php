<x-page-container title="タスクを編集">
    <div class="p-4">
        @livewire(
            'edit-todo', 
            [
                'todo' => $todo,
            ], 
            key($todo->id)
        )    
    </div>
</x-page-container>