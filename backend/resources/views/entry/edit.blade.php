<x-input-form>
    <form id="edit" action="/entry/{{ $entry->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="my-5">
            <label for="company">企業名</label>
            <div class="pt-1">
                <x-jet-input type="text" name="company" list="companies" value="{{ $entry->name }}"></x-jet-input>
                @if(isset($companies))
                <datalist id="companies">
                @foreach($companies as $company)
                    <option value="{{ $company->name }}">
                @endforeach
                </datalist>
                @endif
            </div>
        </div>
        @php 
            $deadline = Illuminate\Support\Carbon::parse($entry->deadline)->format('Y-m-d\TH:i');
            $templates_encoded = [];
            foreach ($templates as $key => $template) {
                array_push($templates_encoded, json_encode($template, JSON_UNESCAPED_UNICODE));
            }
        @endphp 
        <div class="mb-5">
            <label for="deadline">締切日時</label>
            <div class="pt-1">
                <x-jet-input name="deadline" type="datetime-local" step="3600" value="{{ $deadline }}" />
            </div>
        </div>

        @livewire('entry-edit')

        <div>
            
            @if(isset($question_categories))
            <datalist id="question_categories">
            @foreach($question_categories as $question_category)
                <option value="{{ $question_category->name }}">
            @endforeach
            </datalist>
            @endif

            <datalist id="word_counts">
                <template x-for="j in 10">
                    <option :value="j * 100">
                </template>
            </datalist>
            
            @foreach ($questions as $index => $question)
            @php
                $index++;
            @endphp
            <div
            x-data="{
                question: '{{ $question->name }}',
                answer: '{{ $question->answer }}',
                word_count: {{ $question->word_count }},
                templates: {{ json_encode($templates_encoded) }},
                get hitTemplateAnswer() {
                    const templates = this.templates.map(template => JSON.parse(template))
                    const hitTemplate = templates.filter(template => {
                        const templateNameFormat = `${this.question}-${this.word_count}`
                        return templateNameFormat == template.name
                    })
                    return hitTemplate[0]?.answer
                },
                insert() {
                    this.answer = this.hitTemplateAnswer
                }
            }"
            >

                <x-entry.question-form index="{{ $index }}">
                    <x-slot name="question_input">
                        <x-jet-input type="text" list="question_categories" name="question{{ $index }}" x-model="question" class="block w-full"></x-jet-input>
                    </x-slot>
                    <x-slot name="word_count_input">
                        <x-jet-input x-model="word_count" type="number" name="word_count{{ $index }}" list="word_counts"></x-jet-input>
                    </x-slot>
                    <x-slot name="template_insert_btn">
                        <a 
                        href="#" 
                        x-show="hitTemplateAnswer" 
                        style="display: none;"
                        @click.prevent="window.confirm('テンプレートを挿入してよろしいですか？' + '\n' + `最新のテンプレート: ${hitTemplateAnswer}`) ? insert() : false"
                        >テンプレートを挿入</a>
                    </x-slot>
                    <x-slot name="answer">
                        <textarea 
                        x-model="answer" 
                        name="answer{{ $index }}" 
                        class="resize-none w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md" 
                        :class="answer.length > word_count ? 'bg-red-200' : ''" 
                        rows="10"
                        >
                        </textarea>
                    </x-slot>
                </x-entry.question-form>
            </div>
            @endforeach

        </div>
        <div class="mb-5">
            <x-jet-button form="edit">保存</x-jet-button>
        </div>
    </form>
    <form id="delete" action="/entry/{{ $entry->id }}" method="POST" onSubmit="return window.confirm('削除してよろしいですか？')">
    @csrf
    @method('delete')
        <x-jet-danger-button type="submit" form="delete">削除</x-jet-danger-button>
    </form>
</x-input-form>