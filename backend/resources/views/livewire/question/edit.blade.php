<div>
    <div class="" x-data="{editable: false}">
        <div class="flex items-center text-lg pb-1 border-b-2 border-indigo-200 w-1/2" x-show="!editable">
            <p>{{ $question->name }}-{{ $question->word_count }}字</p>
            <div class="pl-3">
                <a href="#" @click.prevent="editable = true">
                    <x-logos.pencil />
                </a>
            </div>
        </div>
        <div class="w-4/5" x-show="editable" style="display: none;">
            <x-question-form>
                <x-slot name="name_input">
                    <x-jet-input wire:model="name" wire:change="save" type="text" list="question_categories" class="block w-full" />
                </x-slot>
                <x-slot name="word_count_input">
                    <x-jet-input wire:model="word_count" wire:change="save" type="number" list="word_counts" />
                </x-slot>
                <x-slot name="btn">
                    <a href="#" @click.prevent="confirm('この設問を削除します。よろしいですか？') ? $wire.delete() : false" class="text-red-600"><x-logos.trash /></a>
                    <a href="#" @click.prevent="editable = false" class="pl-4 text-xl">✖</a>
                </x-slot>
            </x-question-form>
        </div>
    </div> 
    <div class="pt-5 pb-10 flex justify-between w-4/5 relative" x-data="{shown: false}">
        <x-jet-action-message class="pt-2 text-green-500 font-bold absolute" on="answer-saved">
            <p class="flex items-center"><span>保存されました</span><x-logos.check /></p>
        </x-jet-action-message>
        <div class="pr-8 pt-10">
            <div class="">
                <span>文字数：{{ $this->getAnswerLength() }}</span>
            </div>
            <div class="pt-3">
                <a href="#" wire:click.prevent="removeSpace" class="pr-3">空白を削除</a>
            </div>
            <div class="pt-3">
                <a href="#" wire:click.prevent="convertIntoZen">全角に変換</a>
            </div>
            <div class="pt-3">
                <a 
                href="#" 
                @click.prevent="shown = true"
                >テンプレートを表示</a>
                <div 
                class="absolute border-indigo-200 border-2 bg-white w-4/5 p-4 rounded-md bottom-0 left-0" 
                x-show.transition="shown" 
                @click.away="shown = false" 
                @close-modal.window="shown = false" 
                style="display: none;"
                >
                    <div class="relative">
                        <p class="pb-2">現在のテンプレート</p>
                        <p class="pb-5">{{ $this->getTemplate()->answer ?? '登録されているテンプレートがありません' }}</p>
                        @if ($this->getTemplate())
                        <div>
                            <a 
                            href="#" 
                            x-on:click.prevent="confirm('現在のテンプレートを現在の回答に挿入します。よろしいですか？\n※現在の回答は失われます') ? $wire.insertTemplate() : false" 
                            class="inline-block p-2 text-white rounded-md text-sm bg-indigo-400"
                            >挿入する</a> 
                            <a 
                            href="#" 
                            x-on:click.prevent="confirm('現在の回答をテンプレートに反映させます。よろしいですか？\n※現在のテンプレートは失われます') ? $wire.updateTemplate() : false" 
                            class="inline-block p-2 text-white rounded-md text-sm bg-indigo-400"
                            >現在の回答に置き換える</a>
                        </div>
                        @endif
                        <a href="#" @click.prevent="shown = false" class="text-xl text-indigo-400 absolute -top-1 -right-0.5">✖</a>
                    </div>
                </div>
            </div>
        </div>
        <x-forms.textarea
        wire:model.lazy="answer"
        wire:change="saveAnswer"
        class="{{ $this->getAnswerLength() > $word_count ? 'bg-red-200' : '' }} w-4/5 max-w-4xl" 
        rows="10"
        ></x-forms.textarea>
    </div>
</div>