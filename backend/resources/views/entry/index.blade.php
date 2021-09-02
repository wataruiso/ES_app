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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="border-b-2 p-3 flex justify-between">
                    <a href="/entry/create" class="block font-bold text-xl">ESを追加</a>
                </div>
                @if(isset($entries) && count($entries))
                    @foreach ($entries as $entry)
                    <div class="border-b-2 py-2 px-4">
                        <a href="/entry/{{ $entry->id }}/edit">
                            <h3 class="my-2 text-lg">{{ $entry->name }}</h3>
                        </a>
                    </div>
                    @endforeach
                @else
                <div class="py-20 px-4 text-center">
                    <h1 class="text-xl">ESがありません</h1>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
