<div>
    <div class="flex items-center">
        <div class="flex items-center pr-5">
            <label>企業名</label>
            <div class="px-3 flex-1">
                <datalist id="companies">
                @foreach(\App\Models\Company::all() as $company)
                    <option value="{{ $company->name }}">
                @endforeach
                </datalist>
                {{ $company_input }}
            </div>
        </div>
        <div class="flex items-center pr-5">
            <label>カテゴリー</label>
            <div class="px-3 flex-1">
                <datalist id="categories">
                @foreach(\App\Models\EntryCategory::where('name', '!=', 'その他')->get() as $category)
                    <option value="{{ $category->name }}">
                @endforeach
                </datalist>
                {{ $category_input }}
            </div>
        </div>
        <div class="flex items-center">
            <label>締切日時</label>
            <div class="px-3">
                {{ $deadline_input }}
            </div>
        </div>
        <div class="flex items-center">
            {{ $btn ?? '' }}
        </div>
    </div>
    <div class="pt-3">
        @error('company') <p class="text-red-500">{{ $message }}</p> @enderror
        @error('category') <p class="text-red-500">{{ $message }}</p> @enderror
        @error('deadline') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>
</div>