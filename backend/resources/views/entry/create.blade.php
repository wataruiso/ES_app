<x-input-form>
    <form action="/entry" method="POST" enctype="multipart/form-data" onSubmit="return window.confirm('ESを作成します。よろしいですか？\n※設問数の変更は出来ません')">
    @csrf
        
        @php
            $max_question_num = 8;
        @endphp

        <div x-data="{
            maxQuestionNum: {{ $max_question_num }},
            company: '',
            deadline: '{{ date('Y-m-d') . 'T00:00' }}',
            questionNum: 1, 
            questions: [
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
                {
                    title: '',
                    word_count: null,
                },
            ],
            get ableSubmit() {
                if(!(this.company && this.deadline && this.questionNum)) return false
                else if(this.questionNum == 1) return this.questionIsFilled(0)
                else {
                    for(let k = 0; k < this.questionNum; k++) {
                        if(!this.questionIsFilled(k)) return false
                    }
                    return true
                }
            },
            questionIsFilled(index) {
                return this.questions[index].title && this.questions[index].word_count
            }
         }"> 
            <div class="my-5">
                <label for="company">企業名</label>
                <div class="pt-1">
                    <x-jet-input name="company" type="text" list="companies" x-model="company" required></x-jet-input>
                    @if(isset($companies))
                    <datalist id="companies">
                    @foreach($companies as $company)
                        <option value="{{ $company->name }}">
                    @endforeach
                    </datalist>
                    @endif
                </div>
            </div>
            <div class="mb-5">
                <label for="deadline">締切日時</label>
                <div class="pt-1">
                    <x-jet-input name="deadline" type="datetime-local" step="3600" x-model="deadline" />
                </div>
            </div>
            <div class="mb-5">
                <label for="question_num">設問数</label>
                <div class="pt-1">
                    <x-forms.select x-model="questionNum" name="question_num">
                        <template x-for="i in {{ $max_question_num }}">
                            <option :value="i" x-text="i">
                        </template>
                    </x-forms.select>
                </div>
            </div>
            
            <div class="pt-10">
                
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
    
                @php
                    $top_index = 1;
                @endphp

                <div>
                    <x-entry.question-form :editting="false" index="{{ $top_index }}">
                        <x-slot name="question_input">
                            <x-jet-input type="text" list="question_categories" name="question{{ $top_index }}" x-model="questions[{{ $top_index - 1 }}].title" class="block w-full"></x-jet-input>
                        </x-slot>
                        <x-slot name="word_count_input">
                            <x-forms.select name="word_count{{ $top_index }}" x-model="questions[{{ $top_index - 1 }}].word_count">
                                <option value="" x-text="'-'"></option>
                                <template x-for="j in 10">
                                    <option :value="j * 100" x-text="j * 100"></option>
                                </template>
                                <option :value="9999" x-text="'制限なし'"></option>
                            </x-forms.select>
                        </x-slot>
                    </x-entry.question-form>
                </div>
                
                @for ($i = 2; $i <= $max_question_num; $i++)
                    <div x-show="questionNum >= {{ $i }}">
                        <x-entry.question-form :editting="false" index="{{ $i }}">
                            <x-slot name="question_input">
                                <x-jet-input type="text" list="question_categories" name="question{{ $i }}" x-model="questions[{{ $i - 1 }}].title" class="block w-full"></x-jet-input>
                            </x-slot>
                            <x-slot name="word_count_input">
                                <x-forms.select name="word_count{{ $i }}" x-model="questions[{{ $i - 1 }}].word_count">
                                    <option value="" x-text="'-'"></option>
                                    <template x-for="j in 10">
                                        <option :value="j * 100" x-text="j * 100"></option>
                                    </template>
                                    <option :value="9999" x-text="'制限なし'"></option>
                                </x-forms.select>
                            </x-slot>
                        </x-entry.question-form>
                    </div>
                @endfor
            </div>
            <div class="mb-5" x-show="ableSubmit">
                <x-jet-button>作成</x-jet-button>
            </div>
        </div>
    </form>
</x-input-form>