<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('企業リスト') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(isset($companies))
                @foreach ($companies as $company)
                <div x-data="{open: false}" class="border-b-2 py-2 px-4 flex justify-between items-center">  
                    <a href="#" @click.prevent="open = !open" class="block w-4/5">
                        <div>
                            <div class="mb-2 flex items-center">
                                <h3 class="pr-4 text-lg">{{ $company->name }}</h3>
                            </div>
                        </div>
                    </a>
                    <div class="grid grid-cols-3">
                        <div class="flex items-center justify-center">
                    
                        </div>
                        <div class="flex items-center justify-center">
                           
                        </div>
                    </div>                    
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>