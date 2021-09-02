<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('やることリスト') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="border-b-2 p-3 flex justify-between">
                    <a href="/todo/create" class="block font-bold text-xl">タスクを追加</a>
                    <div class="flex items-center">
                        <x-jet-nav-link href="{{ route('todo') }}" class="px-3" :active="request()->routeIs('todo')">
                            未完了
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('todo/complete_todos') }}" class="px-3" :active="request()->routeIs('todo/complete_todos')">
                            完了済
                        </x-jet-nav-link>
                    </div>
                </div>
                @if (isset($todos) && count($todos))
                @foreach ($todos as $todo)
                <div class="border-b-2 py-2 px-4 flex justify-between items-center">  
                    <a href="/todo/{{ $todo->id }}/edit" class="block w-4/5">
                        <div>
                            <div class="mb-2 flex items-center">
                                <h3 class="pr-4 text-lg">{{ $todo->title }}</h3>
                                <time class="text-sm">{{ Illuminate\Support\Carbon::parse($todo->time_to_start)->format('Y/m/d H:i') }}</time>
                            </div>
                            <p class="text-sm">{{ $todo->description }}</p>                                                                                                                                                                                                             
                        </div>
                    </a>
                    
                    <div class="grid grid-cols-3">
                        <span class="block py-1 px-2 rounded-md text-center text-white {{ $todo->is_done  ? 'bg-green-500' : 'bg-red-500'}}">{{ $todo->is_done ? '完了済' : '未完了' }}</span>
                        <div class="flex items-center justify-center">
                            <div class="{{ $todo->is_done ? 'hidden' : '' }}">
                                <form class="flex" action="/todo/{{ $todo->id }}/complete" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <button type-="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="{{ $todo->entry_id ? '' : 'hidden' }}">
                                <a href="/todo/{{ $todo->id }}/edit_entry">
                                    <x-logos.external-link />
                                </a>
                            </div>
                        </div>
                    </div>                    
                </div>
                @endforeach
                @else
                <div class="py-20 px-4 text-center">
                    <h1 class="text-xl">タスクがありません</h1>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<!-- tokui.name.length > 7
                ? tokui.name.substring(0, 7) + "..."
                : tokui.name -->