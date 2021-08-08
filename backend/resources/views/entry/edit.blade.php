<x-input-form>
    <form id="edit" action="/entry/{{ $entry->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="my-5">
            <x-jet-input name="company" list="companies" value="{{ $entry->name }}"></x-jet-input>
            @if(isset($companies))
            <datalist id="companies">
            @foreach($companies as $company)
                <option value="{{ $company->name }}">
            @endforeach
            </datalist>
            @endif
        </div>
        @php 
            $deadline = Illuminate\Support\Carbon::parse($entry->deadline)->format('Y-m-d\TH:i');
        @endphp 
        <div class="mb-5">
            <input name="deadline" type="datetime-local" step="3600" value="{{ $deadline }}" />
        </div>

        <div x-data="{ currentQuestionNum: {{ isset($question_num) ? $question_num : 1 }} }">
            
            @if(isset($question_categories))
            <datalist id="question_categories">
            @foreach($question_categories as $question_category)
                <option value="{{ $question_category->name }}">
            @endforeach
            </datalist>
            @endif

            <datalist id="word_counts">
                <template x-for="i in 10">
                    <option :value="i * 100">
                </template>
            </datalist>

            @foreach ($questions as $index => $question)
                @php
                    $index++;
                @endphp
                <div x-show="currentQuestionNum == {{ $index }}">
                    <div x-data="{answer: '{{ $question->answer }}', word_count: {{ $question->word_count }} }">
                        <x-entry.question-form>
                            <x-slot name="question">
                                <x-jet-input list="question_categories" name="question{{ $index }}" value="{{ $question->name }}"></x-jet-input>
                            </x-slot>
                            <x-slot name="word_count">
                                <x-jet-input x-model="word_count" type="number" name="word_count{{ $index }}" list="word_counts"></x-jet-input>
                            </x-slot>
                            <x-slot name="answer">
                                <textarea 
                                x-model="answer" 
                                name="answer{{ $index }}" 
                                class="w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md" 
                                :class="answer.length > word_count ? 'bg-red-200' : ''" 
                                rows="10"
                                >
                                </textarea>
                            </x-slot>
                        </x-entry.question-form>
                    </div>
                </div>
            @endforeach

            


            <div class="mb-5 flex justify-center">
                <p>設問数：</p>
                <div>
                    <template x-for="i in {{ count($questions) }}">
                    <a href="#" class="shadow-md px-4 rounded-sm" :class="currentQuestionNum == i ? 'bg-purple-400' : ''" @click.prevent="currentQuestionNum = i" x-text="i"></a>
                    </template>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <x-jet-button form="edit">編集</x-jet-button>
        </div>
    </form>
    <form id="delete" action="/entry/{{ $entry->id }}" method="POST" onSubmit="return window.confirm('削除してよろしいですか？')">
    @csrf
    @method('delete')
        <x-jet-danger-button type="submit" form="delete">削除</x-jet-danger-button>
    </form>
</x-input-form>