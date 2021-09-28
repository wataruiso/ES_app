<div class="border-b-2 py-3 px-4" x-data="{editable: false}"> 
    <div class="flex items-center" x-show="!editable">
        <a href="#" @click.prevent="editable = true" class="block w-4/5">
            <div>
                <div class="mb-2 flex items-center">
                    <h3 class="pr-4 text-lg">{{ $todo->title }}</h3>
                    <time class="text-sm">{{ \Util::getDisplayDatetime($todo->start_at) }}</time>
                </div>
                <p class="text-sm">{{ $todo->description }}</p>                                                                                                                                                                                                             
            </div>
        </a>
       
        <div class="pl-8 flex items-center">
            <span class="block py-1 px-2 rounded-md text-center text-white {{ $todo->is_done  ? 'bg-green-500' : 'bg-red-500'}}">{{ $todo->is_done ? '完了済' : '未完了' }}</span>
            <div class="pl-8 flex items-center justify-center {{ $todo->entry_id ? '' : 'hidden' }}">
                <a href="/entry/{{ $todo->entry_id }}/edit">
                    <x-logos.external-link />
                </a>
            </div>
        </div>     
    </div>

    <div x-show="editable" class="pt-3">
        <x-todo-form>
            <x-slot name="title_input">
                <x-jet-input type="text" wire:change="save" wire:model="title" class="block w-full" />
            </x-slot>
            <x-slot name="start_at_input">
                <x-jet-input type="datetime-local" step="3600" wire:change="saveStartAt" wire:model="start_at" />
            </x-slot>
            <x-slot name="end_at_input">
                <x-jet-input type="datetime-local" step="3600" wire:change="saveEndAt" wire:model="end_at" />
            </x-slot>
            <x-slot name="description_input">
                <x-forms.textarea 
                class="w-full"
                rows="6"
                wire:change="save"
                wire:model="description"
                ></x-forms.textarea>
            </x-slot>
            <x-slot name="close_btn">
                <a href="#" @click.prevent="editable = false" class="text-xl">✖</a>
            </x-slot>
            <x-slot name="submit_btn">
                <div class="flex items-center">
                    <div class="flex items-center pr-4">
                        <x-jet-input id="is_done" type="checkbox" wire:change="save" wire:model="is_done" />
                        <label for="is_done" class="pl-3">完了済み</label>
                    </div>
                    <a href="#" @click.prevent="confirm('このタスクを削除します。よろしいですか？') ? $wire.delete() : false" class="text-red-600"><x-logos.trash /></a>
                </div>
            </x-slot>
        </x-todo-form>
    </div>
                   
</div>

