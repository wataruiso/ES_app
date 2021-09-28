<x-page-container title="設問の回答を編集">
    <div class="p-4">
        @livewire(
        'edit-entry', 
        [
            'entry' => $entry,
        ])    
    
        <div class="pb-6" x-data="{formShown: false}">
            <div class="rounded-md p-3 border-2 shadow inline-block" x-show="!formShown">
                <a href="#" @click.prevent="formShown = true" class="flex items-center">
                    <b class="flex items-center pr-3 top-0.5 relative">
                        <span>設問を追加</span>
                    </b>
                    <x-logos.plus />
                </a>
            </div>
            <div class="w-4/5" x-show="formShown" style="display: none;">
                @livewire(
                'create-question', 
                [
                'entry_id' => $entry->id,
                ])
            </div>
        </div>
        
        <div>
            @foreach ($entry->questions as $question)
                @livewire(
                'edit-question', 
                [
                'question' => $question,
                ])
            @endforeach
        </div>
    </div>    
</x-page-container>