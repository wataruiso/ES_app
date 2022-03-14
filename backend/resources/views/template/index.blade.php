<x-page-container title="テンプレートリスト">
    @if(isset($templates))
    @foreach ($templates as $index => $template)
    <div class="border-b-2 py-2 px-4" x-data="{
        answer{{ $index }}: '{{ $template->answer }}',
        copied: false,
        open: false,
    }">  
        <div class="py-1 flex items-center">
            <a href="" @click.prevent="open = !open" class="text-lg flex items-center">
                {{ $template->name }}-{{ $template->word_count }}字
                @if(isset($template->updated_at))
                <span class="pl-4 text-sm">
                    {{ Illuminate\Support\Carbon::parse($template->updated_at)->diffForHumans() }}
                </span>
                @endif
            </a>
            @if ($template->answer)
            <div x-show.transition="open" style="display: none;" class="flex items-center justify-center pl-4">
                <a href="#" @click.prevent="navigator.clipboard.writeText(answer{{$index}}).then(e => {
                    if(copied) return
                    copied = true
                    setTimeout(() => {
                        copied = false
                    }, 2000)
                });">
                    <x-logos.clipboard-copy />
                </a>
                <span class="text-sm pl-3 bold" style="display: none;" x-show.transition="copied">Copied!</span>
            </div>
            @endif
        </div>
        @if ($template->answer)
        <div x-show.transition="open" style="display: none;" class="flex justify-between items-center py-2">
            <p x-text="answer{{ $index }}"></p>
        </div>
        @endif        
    </div>
    @endforeach
    @endif
</x-page-container>