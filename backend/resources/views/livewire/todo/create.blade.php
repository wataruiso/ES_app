<div>
    <div class="mb-5">
        <x-jet-input wire:model="title" />
    </div>
    <div class="mb-5 flex items-center">
        <x-jet-input type="datetime-local" step="3600" wire:model="start_at" />
        <div>
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
    <div>
        <x-jet-button>作成</x-jet-button>
    </div>
</div>
