<x-todo-form>
    <x-slot name="title_input">
        <x-jet-input type="text" wire:model="title" class="block w-full" />
    </x-slot>
    <x-slot name="start_at_input">
        <x-jet-input type="datetime-local" step="3600" wire:change="fixEndAt" wire:model="start_at" />
    </x-slot>
    <x-slot name="end_at_input">
        <x-jet-input type="datetime-local" step="3600" wire:change="fixStartAt" wire:model="end_at" />
    </x-slot>
    <x-slot name="description_input">
        <x-forms.textarea 
        class="w-full"
        rows="6"
        wire:model="description"
        ></x-forms.textarea>
    </x-slot>
    <x-slot name="close_btn">
        <a href="#" @click.prevent="editable = false" class="text-xl">✖</a>
    </x-slot>
    <x-slot name="submit_btn">
        <x-jet-button wire:click.prevent="save">作成</x-jet-button>
    </x-slot>
</x-todo-form>