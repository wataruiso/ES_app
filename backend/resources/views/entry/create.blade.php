<x-input-form>
    <form action="/entry" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="my-5">
            <label for="company">企業名</label>
            <x-jet-input name="company" list="companies" value="{{ old('company') }}" required></x-jet-input>
            @if(isset($companies))
            <datalist id="companies">
            @foreach($companies as $company)
                <option value="{{ $company->name }}">
            @endforeach
            </datalist>
            @endif
        </div>
        <div class="mb-5">
            <label for="deadline">締切日時</label>
            <input name="deadline" type="datetime-local" step="3600" value="{{ date('Y-m-d') . 'T00:00' }}" />
        </div>

        @php
            $max_question_num = 8;
        @endphp
        
        <div x-data="{ currentQuestionNum: 1, questionNum: 3, maxQuestionNum: {{ $max_question_num }} }" class="pt-10">

            <input class="hidden" type="number" x-model="questionNum" name="question_num">
            
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

            @for ($i = 1; $i <= $max_question_num; $i++)
                <div x-show="currentQuestionNum == {{ $i }}">
                    <div x-data="{answer: '', word_count: 0}">
                        <x-entry.question-form>
                            <x-slot name="question">
                                <span>{{$i}}問目</span>
                                <label for="question">設問タイトル</label>
                                <x-jet-input list="question_categories" name="question{{ $i }}" value="{{ old('question' . $i) }}" required></x-jet-input>
                            </x-slot>
                            <x-slot name="word_count">
                                <x-jet-input x-model="word_count" type="number" name="word_count{{ $i }}" list="word_counts"></x-jet-input>
                            </x-slot>
                            <x-slot name="answer">
                                <textarea 
                                x-model="answer" 
                                name="answer{{ $i }}" 
                                class="w-4/5 max-w-4xl border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-md" 
                                :class="answer.length > word_count ? 'bg-red-200' : ''" 
                                rows="10"
                                ></textarea>
                            </x-slot>
                        </x-entry.question-form>
                    </div>
                </div>
            @endfor

            


            <div class="mb-5 flex justify-center mx-auto">
                <p class="">設問数：</p>
                <div class="grid grid-cols-{{ $max_question_num }} px-5">
                    <template x-for="i in questionNum">
                    <div><a href="#" class="shadow-md px-4 rounded-sm" :class="currentQuestionNum == i ? 'bg-purple-400' : ''" @click.prevent="currentQuestionNum = i" x-text="i"></a></div>
                    </template>
                </div>
                <div class="grid grid-cols-2">
                    <div>
                        <a href="#" class="px-4" :class="questionNum == 1 ? 'hidden' : ''" @click.prevent="questionNum--">-</a>
                    </div>
                    <div>
                        <a href="#" class="px-4" :class="questionNum == maxQuestionNum ? 'hidden' : ''" @click.prevent="questionNum++">+</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <x-jet-button>作成</x-jet-button>
        </div>
    </form>
</x-input-form>