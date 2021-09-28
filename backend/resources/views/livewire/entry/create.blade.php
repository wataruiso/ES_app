<x-entry-form>
     <x-slot name="company_input">
          <x-jet-input type="text" list="companies" wire:model="company" />
     </x-slot>
     <x-slot name="category_input">
          <x-jet-input type="text" list="categories" wire:model="category" />
     </x-slot>
     <x-slot name="deadline_input">
          <x-jet-input type="datetime-local" step="3600" wire:model="deadline" />
     </x-slot>
     <x-slot name="btn">
          <div class="pl-4">
          <x-jet-button wire:click.prevent="save">作成</x-jet-button>
          </div>
          <a href="#" @click.prevent="editable = false" class="pl-4 text-xl">✖</a>
     </x-slot>
</x-entry-form>
