<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('エントリーシート') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg lg:grid grid-cols-3 gap-4">
            <a href="/entry/create" class="p-3 font-bold text-xl">ESを追加</a>
                @if(isset($entries))
                    @foreach ($entries as $entry)
                    <div>
                        <a href="/entry/{{ $entry->id }}/edit">
                        <h3 class="my-6 text-lg">{{ $entry->deadline }}</h3>
                        <p class="text-sm">{{ $entry->name }}</p>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
