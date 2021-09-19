<x-page-container title="設問の回答を編集">
    <div class="p-4">
        @livewire(
            'edit-entry', 
            [
                'entry' => $entry,
            ], 
            key($entry->id)
        )    
    </div>    
</x-page-container>