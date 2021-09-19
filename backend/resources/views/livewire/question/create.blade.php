<div x-data="{formShown: false}">
    <div class="rounded-md p-3 border-2 shadow inline-block" x-show="!formShown">
        <a href="#" @click.prevent="formShown = true" class="flex items-center">
            <b class="flex items-center pr-3 top-0.5 relative">
                <span>設問を追加</span>
            </b>
            <x-logos.plus></x-logos.plus>
        </a>
    </div>
    <div class="w-4/5" x-show="formShown">
            <x-question-form>
                <x-slot name="name_input">
                    <x-jet-input wire:model="name" type="text" list="question_categories" class="block w-full"></x-jet-input>
                </x-slot>
                <x-slot name="word_count_input">
                    <x-jet-input wire:model="word_count" type="number" list="word_counts"></x-jet-input>
                </x-slot>
                <x-slot name="btn">
                    <div class="pl-4">
                        <x-jet-button wire:click.prevent="save">作成</x-jet-button>
                    </div>
                    <a href="#" @click.prevent="formShown = false" class="pl-4 text-xl">✖</a>
                </x-slot>
            </x-question-form>
    </div>
</div>