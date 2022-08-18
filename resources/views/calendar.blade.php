<x-calendar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベントカレンダー
        </h2>
    </x-slot>

    {{-- <div class="py-12"> --}}
    <div class="py-4">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
            {{-- 少し小さいし、可変になっているので、削除 --}}
        <div class="event-calendar mx-auto sm:px-6 lg:px-8">
            {{-- ↑ --}}
        {{-- <div class="event-calendar border border-red-400 mx-auto sm:px-6 lg:px-8"> --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- <div class="max-w-2xl mx-auto py-4"> --}}
                    {{-- 少し小さいし、可変になっているので、削除 --}}

                    @livewire('calendar')

                {{-- </div> --}}
            </div>
        </div>
    </div>

    @livewireScripts

</x-calendar-layout>
