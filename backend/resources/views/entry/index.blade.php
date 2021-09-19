<x-page-container title="エントリーシート">
    <div class="border-b-2 p-3 flex justify-between" x-data="{editable: false}">
        <a href="#" @click.prevent="editable = true" x-show="!editable" class="block font-bold text-xl">ESを追加</a>
        <div x-show="editable" class="pt-3">
            @livewire('create-entry')
        </div>
    </div>
    @if(isset($entries) && count($entries))
        @foreach ($entries as $entry)
        <div class="border-b-2 py-2 px-4">
            <a href="/entry/{{ $entry->id }}/edit">
                <h3 class="my-2 text-lg">{{ $entry->name }}-{{ $entry->category }}</h3>
            </a>
        </div>
        @endforeach
    @else
    <div class="py-20 px-4 text-center">
        <h1 class="text-xl">ESがありません</h1>
    </div>
    @endif
</x-page-container>
