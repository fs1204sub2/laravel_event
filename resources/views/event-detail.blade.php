{{-- resources/views/event-detail.blade.php
manager/events/show.blade.phpをコピーして不要な箇所を削除  --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント詳細
        </h2>
    </x-slot>

    <div class="pt-4 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="max-w-2xl mx-auto py-4">

                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('events.reserve', ['id' => $event->id]) }}">
                        @csrf
                        {{-- post通信をするときは、必ず必要。 --}}

                        <div class="mt-4">
                            <x-jet-label for="event_name" value="イベント名" />
                            {{ $event->name }}
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="information" value="イベント詳細" />
                            {!! nl2br(e($event->information)) !!}
                        </div>

                        <div class="md:flex justify-between">

                            <div class="mt-4">
                                <x-jet-label for="event_date" value="イベント日付" />
                                {{-- {{ $eventDate }} --}} {{-- アクセサを使う --}}
                                {{ $event->eventDate }}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="start_time" value="開始時間" />
                                {{-- {{ $startTime }} --}}
                                {{ $event->startTime }}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="end_time" value="終了時間" />
                                {{-- {{ $endTime }} --}}
                                {{ $event->endTime }}
                            </div>
                        </div>

                        <div class="mt-4 md:flex justify-between items_center ">
                            <div class="mt-4">
                                <x-jet-label for="max_people" value="定員数" />
                                {{ $event->max_people }}
                            </div>

                            {{-- 定員数をコピー --}}
                            <div class="mt-4">
                                <x-jet-label for="reserved_people" value="予約人数" />
                                <select name="reserved_people">
                                    @for ($i = 1; $i <= $resevablePeople; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>


                            {{-- 不要なのでカット --}}
                            {{-- <div class="flex space-x-4 justify-around">
                                @if($event->is_visible)
                                    表示中
                                @else
                                    非表示中
                                @endif
                            </div> --}}

                            <input type="hidden" name="id" value="{{ $event->id }}">
                            {{-- イベントのidを渡す。 --}}

                            <x-jet-button class="ml-4">
                                {{-- 編集する --}}
                                予約する
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--
{{--    不要なので消す。
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-4">
                    @if (!$users->isEmpty())
                        <div class="text-center py-2">
                            予約情報
                        </div>

                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約者名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    @if(is_null($reservation['canceled_date']))
                                        <tr>
                                            <td class="px-4 py-3">{{ $reservation['name'] }}</td>
                                            <td class="px-4 py-3">{{ $reservation['number_of_people'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

</x-app-layout>
