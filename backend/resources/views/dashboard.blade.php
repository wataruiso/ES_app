<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-3 gap-4">
            <a href="/todo/create" class="p-3 font-bold text-xl">create</a>
                @foreach ($todos as $todo)
                <div>
                    <h3>{{ $todo->title }}</h3>
                    <p>{{ $todo->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
