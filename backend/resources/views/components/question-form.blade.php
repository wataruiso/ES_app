<div>
    <div class="flex justify-between items-center">
        <div class="flex justify-between items-center flex-1 pr-5">
            <label>設問タイトル</label>
            <div class="px-3 flex-1">
                <datalist id="question_categories">
                    @foreach(\App\Models\QuestionCategory::where('name', '!=', 'その他')->get() as $question_category)
                        <option value="{{ $question_category->name }}">
                    @endforeach
                </datalist>
                {{ $name_input }}
            </div>
        </div>
        <div class="flex items-center">
            <label>文字数</label>
            <div class="px-3">
                <datalist id="word_counts">
                    <template x-for="i in 10">
                        <option :value="i * 100">
                    </template>
                </datalist>
                {{ $word_count_input }}
            </div>
        </div>
        <div class="flex items-center">
            {{ $btn ?? '' }}
        </div>
    </div>
    <div class="pt-3">
        @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
        @error('word_count') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>
</div>