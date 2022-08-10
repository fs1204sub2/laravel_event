<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- デザインを整える --}}
                <div class="max-w-2xl mx-auto py-4">

                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <form method="POST" action="{{ route('events.store') }}"> --}}
                    <form method="GET" action="{{ route('events.edit', ['event' => $event->id]) }}">
                        {{-- @csrf GETメソッドのときはcsrfなくてもOK--}}

                        <div class="mt-4">
                            <x-jet-label for="event_name" value="イベント名" />
                            {{-- <x-jet-input id="event_name" class="block mt-1 w-full" type="text" name="event_name" :value="old('event_name')" required autofocus /> --}}
                            {{-- requiredで必須となり、autofocusも当たっている状態 --}}
                            {{ $event->name }}
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="information" value="イベント詳細" />
                                {{-- classにはinputのclassと合わせる --}}
                            {{-- <x-textarea row="3" id="information" name="information" class="block mt-1 w-full">{{ old('information')    }}</x-textarea> --}}

                            {{-- {{ $event->information }} --}}
                            {{-- このままだと改行されないで表示されてしまう 確認するために新規登録する
                                aaa
                                bbb
                                としたのに、 aaa bbb というようになる   改行が空白に変わっている --}}

                            {!! nl2br(e($event->information)) !!}

                        </div>

                        {{-- デザイン --}}
                        <div class="md:flex justify-between">

                            <div class="mt-4">
                                <x-jet-label for="event_date" value="イベント日付" />
                                {{-- <x-jet-input id="event_date" class="block mt-1 w-full" type="text" name="event_date" required/> --}}
                                {{ $eventDate }} {{-- 2022年07月01日 --}}
                                {{-- {{ $event->start_date }}2022-07-01 07:14:51 --}}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="start_time" value="開始時間" />
                                {{-- <x-jet-input id="start_time" class="block mt-1 w-full" type="text" name="start_time" required/> --}}
                                {{ $startTime }} {{-- 07時14分 --}}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="end_time" value="終了時間" />
                                {{-- <x-jet-input id="end_time" class="block mt-1 w-full" type="text" name="end_time"/> --}}
                                {{ $endTime }}  {{-- 07時14分 --}}
                                {{-- {{ $event->end_date }}  2022-07-01 08:14:51 --}}
                            </div>
                        </div>

                        {{-- <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div> --}}

                        <div class="mt-4 md:flex justify-between items_center ">
                            <div class="mt-4">
                                <x-jet-label for="max_people" value="定員数" />
                                {{-- <x-jet-input id="max_people" class="block mt-1 w-full" type="number" name="max_people"/> --}}
                                {{ $event->max_people }}
                            </div>
                            <div class="flex space-x-4 justify-around">
                                {{-- <input type="radio" name="is_visible" value="1" checked/>表示
                                <input type="radio" name="is_visible" value="0"/>非表示 --}}
                                @if($event->is_visible)
                                    表示中
                                    {{-- {{ $event->is_visible }} 1 --}}
                                @else
                                    非表示中
                                    {{-- {{ $event->is_visible }} 0 --}}
                                @endif
                            </div>

                            @if ($eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                                <x-jet-button class="ml-4">
                                    編集する
                                </x-jet-button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
