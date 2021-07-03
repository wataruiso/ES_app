@component('components.input-form')
    <form action="/entry" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="my-5">
            <x-jet-input name="company" list="companies" value="{{ old('company') }}"></x-jet-input>
            @if(isset($companies))
            <datalist id="companies">
            @foreach($companies as $company)
                <option value="{{ $company->name }}">
            @endforeach
            </datalist>
            @endif
        </div>
        <div class="mb-5">
            <input name="deadline" type="datetime-local" step="3600" value="{{ date('Y-m-d') . 'T00:00' }}" />
        </div>
        
        <div x-data="{ questionNum: 1, maxQuestionNum: 8 }">
            
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
            

            <div x-show="questionNum == 1">
                <div class="mb-5">
                    <x-jet-input list="question_categories" name="question1" value="{{ old('question1') }}"></x-jet-input>
                </div>
                <div  x-data="{answer1: '', word_count1: 0}" class="mb-5 flex justify-between">
                    <div>
                        <div class="grid grid-cols-2 gap-4 px-5 text-center">
                            <div class="flex flex-col justify-center px-5">
                                <span class="px-3" x-text="answer1.length"></span>
                            </div>
                            <x-jet-input x-model="word_count1" type="number" name="word_count1" list="word_counts" value="{{ old('word_count1') }}"></x-jet-input>
                            <a href="#" @click.prevent="answer1 = answer1.replace(/\s+/g, '');">空白を削除</a>
                            <a href="#" @click.prevent="answer1 = answer1.replace(/[A-Za-z0-9]/g, function(s) {
                                return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
                                });">全角に変換
                            </a>
                        </div>
                    </div>
                    <textarea x-model="answer1" name="answer1" class="w-4/5 max-w-4xl" :class="answer1.length > word_count1 ? 'bg-red-200' : ''" rows="10">{{ old('answer1') }}</textarea>
                </div>
            </div>




            <div class="mb-5 flex justify-between">
                <div  class="shadow-md">
                    <div :class="questionNum == 1 ? 'hidden' : ''" @click.prevent="questionNum--"><<</div>
                </div>
                <template x-for="i in maxQuestionNum">
                <a href="#" class="shadow-md" :class="questionNum == i ? 'bg-purple-400' : ''" @click.prevent="questionNum = i" x-text="i"></a>
                </template>
                <div  class="shadow-md">
                    <div :class="questionNum == maxQuestionNum ? 'hidden' : ''" @click.prevent="questionNum++">>></div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <x-jet-button>作成</x-jet-button>
        </div>
    </form>
@endcomponent