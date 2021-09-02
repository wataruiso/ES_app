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
                @foreach ($templates as $index => $template)
                <div class="border-b-2 py-2 px-4" x-data="{
                    answer{{ $index }}: '{{ $template->answer }}',
                    copied: false,
                    open: false,
                }">  
                    <a href="" @click.prevent="open = !open">
                        <div class="mb-2 flex items-center">
                            <h3 class="pr-4 text-lg">{{ $template->name }}</h3>
                            @if (isset($template->updated_at))
                            <span class="text-sm">{{ $template->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                        @if ($template->answer)
                        <div x-show="open" style="display: none;" class="flex justify-between items-center">
                            <p x-text="answer{{ $index }}"></p>
                            <div class="flex items-center justify-center pr-4">
                                <span class="text-sm pr-3 bold transition duration-300" style="display: none;" x-show="copied">Copied!</span>
                                <a href="#" @click.prevent="navigator.clipboard.writeText(answer{{$index}}).then(e => {
                                    if(copied) return
                                    copied = true
                                    setTimeout(() => {
                                        copied = false
                                    }, 2000)
                                });">
                                    <x-logos.clipboard-copy />
                                </a>
                            </div>
                        </div>
                        @endif        
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>