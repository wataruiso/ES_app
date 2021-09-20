<div>
    <div class="mb-5">
        <x-jet-input wire:model="title" />
    </div>   
    <div class="mb-5 flex items-center">
        <x-jet-input type="datetime-local" step="3600" wire:model="start_at" />
        <div class="">
            <span>~</span>
            <x-jet-input type="datetime-local" step="3600" wire:model="end_at" />
        </div>
    </div>     
    <div class="mb-5">      
        <x-forms.textarea 
            class="w-4/5 max-w-4xl"
            rows="10"
            wire:model="description"
            ></x-forms.textarea>
    </div>  
    <div class="mb-5 text-sm flex items-center">
        <x-jet-input type="checkbox" wire:model="is_done" />
        <span class="pl-3">完了済み</span>
    </div>    
    <div class="mb-5">
        <x-jet-button form="edit">編集</x-jet-button>
    </div>

    <x-jet-danger-button type="submit" form="delete">削除</x-jet-danger-button>
</div>