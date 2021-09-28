<div x-data="{editable: false}" class="pb-6">
    <div class="flex items-center" x-show="!editable">
        <p class="text-2xl">{{ $this->getCompany()->name }}-{{ $entry->category_name }}ES： {{ \Util::getDisplayDatetime($this->entry->deadline) }}締切</p>
        <div class="pl-3">
            <a href="#" @click.prevent="editable = true">
                <x-logos.pencil></x-logos.pencil>
            </a>
        </div>  
    </div>
    <div x-show="editable" style="display: none;">
       <x-entry-form>
           <x-slot name="company_input">
                <x-jet-input type="text" list="companies" wire:model="company" wire:change="save" />
           </x-slot>
           <x-slot name="category_input">
                <x-jet-input type="text" list="categories" wire:model="category" wire:change="save" />
           </x-slot>
           <x-slot name="deadline_input">
                <x-jet-input type="datetime-local" step="3600" wire:model="deadline" wire:change="save" />
           </x-slot>
           <x-slot name="btn">
                <a href="#" @click.prevent="confirm('このESを削除します。よろしいですか？') ? $wire.delete() : false" class="text-red-600"><x-logos.trash /></a>
                <a href="#" @click.prevent="editable = false" class="pl-4 text-xl">✖</a>
           </x-slot>
       </x-entry-form>
    </div>
</div>