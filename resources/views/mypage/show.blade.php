{{-- manager/events/show.blade.phpをコピー --}}

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

                    {{-- <form method="GET" action="{{ route('events.edit', ['event' => $event->id]) }}"> --}}
                    {{-- formは一旦コメントアウトしておく --}}

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
                                {{ $event->eventDate }}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="start_time" value="開始時間" />
                                {{ $event->startTime }} {{-- 07時14分 --}}
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="end_time" value="終了時間" />
                                {{ $event->endTime }}
                            </div>
                        </div>

                        <div class="mt-4 md:flex justify-between items_center ">
                            <div class="mt-4">
                                {{-- <x-jet-label value="予約人数" /> --}}
                                {{-- inputを使わないので、labelは削除 --}}
                                {{-- <x-jet-label for="max_people" value="定員数" /> --}}
                                {{-- {{ $event->max_people }} --}}
                                {{ $reservation->number_of_people }}
                            </div>
                            {{-- 必要ない --}}
                            {{-- <div class="flex space-x-4 justify-around">
                                @if($event->is_visible)
                                    表示中
                                @else
                                    非表示中
                                @endif
                            </div> --}}

                    {{-- formタグ自体がイベント名や詳細には影響しないため、キャンセルボタンだけ囲む方が、htmlの構造的に良い--}}
                    {{-- JSで動かすためにformにidをつける --}}
                    <form id="cancel_{{ $event->id }}" method="post" action="{{ route('mypage.cancel', ['id' => $event->id] )}}">
                            @csrf

                            {{-- 本日を含む未来のものならキャンセルできる 過去のものならキャンセルできない --}}
                            {{-- >= を < と変更すると、ダミーデータの都合上、キャンセルが表示される --}}
                            @if ($event->eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                                {{-- <x-jet-button class="ml-4">
                                    キャンセルする
                                </x-jet-button> --}}
                                {{-- ボタンタグでは少しうまくいかなかった --}}
                                                                                                {{-- aタグのままだとわかりにくい --}}
                                <a href="#" data-id="{{ $event->id }}" onclick="cancelPost(this)" class="ml-4 bg-black text-white py-2 px-4">
                                    キャンセルする
                                </a>
                                {{-- JS で dataset.id で $event->id を取得できる--}}
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        'use strict';
        function cancelPost(e) {
            if (confirm('本当にキャンセルしてもよろしいですか？')) {
                document.getElementById('cancel_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
