<x-question-form>
    <x-slot name="name_input">
        <x-jet-input wire:model="name" type="text" list="question_categories" class="block w-full" />
    </x-slot>
    <x-slot name="word_count_input">
        <x-jet-input wire:model="word_count" type="number" list="word_counts" />
    </x-slot>
    <x-slot name="btn">
        <div class="pl-4">
            <x-jet-button wire:click.prevent="save">作成</x-jet-button>
        </div>
        <a href="#" @click.prevent="formShown = false" class="pl-4 text-xl">✖</a>
    </x-slot>
</x-question-form>