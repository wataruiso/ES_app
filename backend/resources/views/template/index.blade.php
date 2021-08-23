<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('テンプレートリスト') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(isset($templates))
                @foreach ($templates as $template)
                <div class="border-b-2 py-2 px-4">  
                    <div class="flex justify-between items-center">
                        <div class="flex-1 pr-10">
                            <div class="mb-2 flex items-center">
                                <h3 class="pr-4 text-lg">{{ $template->name }}</h3>
                            </div>
                        </div>
                        <div class="grid grid-cols-3">
                            <div class="flex items-center justify-center">
                                <a href="#" @click.prevent="$refs.answer.select();document.execCommand('copy')">
                                    <x-logos.clipboard-copy />
                                </a>
                            </div>
                            <div class="flex items-center justify-center">
                               
                            </div>
                        </div>
                    </div>
                    @if ($template->answer)
                        <x-forms.textarea x-ref="answer" x-show="open" class="text-sm w-4/5" rows="10" readonly>{{ $template->answer }}</x-forms.textarea>   
                    @endif                        
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>