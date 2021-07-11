<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('設問リスト') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="border-b-2 p-3 flex justify-between">
                    @sortablelink('name', '名前')
                    @sortablelink('word_count', '文字数')
                    @sortablelink('updated_at', '更新日')
                </div>
                @if(isset($questions))
                @foreach ($questions as $question)
                <div x-data="{open: false}" class="border-b-2 py-2 px-4 flex justify-between items-center">  
                    <a href="#" @click.prevent="open = !open" class="block w-4/5">
                        <div>
                            <div class="mb-2 flex items-center">
                                <h3 class="pr-4 text-lg">{{ $question->name }}</h3>
                                <span>{{ $question->word_count }}</span>
                            </div>
                            <p x-show="open" class="text-sm">{{ $question->answer }}</p>                                                                                                                                                                                                             
                        </div>
                    </a>
                    <div class="grid grid-cols-3">
                        <div class="flex items-center justify-center">
                           <a href="/entry/{{ $question->entry_id }}/edit?question_num={{ $question->question_num }}">
                               <x-logos.external-link />
                           </a>
                        </div>
                        <div class="flex items-center justify-center">
                           
                        </div>
                    </div>                    
                </div>
                @endforeach
                @endif
                <div>
                    {{ $questions->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>