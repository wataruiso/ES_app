<div>
    <div class="mb-5 flex items-center">
        <div class="flex flex-1 items-center pr-5">
            <label>タイトル</label>
            <div class="px-3 flex-1">
                {{ $title_input }}
            </div>
        </div>
        <div class="flex items-center pr-5">
            <label>予定日時</label>
            <div class="px-3">
                {{ $start_at_input }}
            </div>
            <span>~</span>
            <div class="px-3">
                {{ $end_at_input }}
            </div>
        </div>
        <div class="flex items-center pr-5">
            {{ $close_btn ?? '' }}
        </div>
    </div>
    <div class="mb-3">
        {{ $description_input }}
    </div>
    <div class="flex justify-between">
        <div class="px-1">
            @error('title') <p class="text-red-500">{{ $message }}</p> @enderror
            @error('start_at') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        <div class="px-1">
            {{ $submit_btn ?? '' }}
        </div>
    </div>
</div>