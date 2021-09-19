<x-page-container title="設問リスト">
    <div class="border-b-2 p-3 flex">
        <p class="flex justify-center items-center">
            <x-logos.sort-descending />
        </p>
        <p class="pl-3">@sortablelink('name', '名前')</p>
        <p class="pl-3">@sortablelink('word_count', '文字数')</p>
        <p class="pl-3">@sortablelink('updated_at', '更新日')</p>
        <p class="pl-3">@sortablelink('company_name', '会社名')</p>
    </div>
    @if(isset($questions) && count($questions))
    @foreach ($questions as $question)
    <div x-data="{open: false}" class="border-b-2 py-2 px-4 flex justify-between items-center">  
        <a href="#" @click.prevent="open = !open" class="block w-4/5">
            <div>
                <div class="mb-2 flex items-center">
                    <h3 class="pr-4 text-lg">{{ $question->name }}</h3>
                    <span class="pr-4">{{ $question->word_count }}字</span>
                    <span class="pr-4">{{ $question->company_name }}</span>
                    <span>{{ $question->updated_at->diffForHumans() }}</span>
                </div>
                <p x-show="open" class="text-sm">{{ $question->answer }}</p>                                                                                                                                                                                                             
            </div>
        </a>
        <div class="grid grid-cols-3">
            <div class="flex items-center justify-center">
               <a href="/entry/{{ $question->entry_id }}/edit">
                   <x-logos.external-link />
               </a>
            </div>
            <div class="flex items-center justify-center">
               
            </div>
        </div>                    
    </div>
    @endforeach
    @else
    <div class="py-20 px-4 text-center">
        <h1 class="text-xl">設問がありません</h1>
    </div>
    @endif
    <div>
        {{ $questions->appends(request()->query())->links() }}
    </div>
</x-page-container>