{{-- manager/events/index.blade.phpをコピー
以前はコレクション型だったので、$event-> という書き方
今回は連想配列なので、$event[''] という書き方になる --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約済みのイベント一覧
        </h2>
    </x-slot>

    {{-- 今日以降のイベント --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-4 mx-auto">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- 今回はいらない --}}
                        {{-- <div class="flex justify-between">
                            <button onclick="location.href='{{ route('events.create')}}'" class="flex mb-4 ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</button>
                            <button onclick="location.href='{{ route('events.past')}}'" class="flex mb-4 ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">過去のイベント一覧</button>
                        </div> --}}

                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">イベント名</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">開始日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">終了日時</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                              {{-- 今回はいらない --}}
                              {{-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">定員</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">表示・非表示</th> --}}
                            </tr>
                          </thead>
                          <tbody>
                            {{-- @foreach($events as $event) --}}
                            @foreach($fromTodayEvents as $event)    {{--  ユーザーが予約しているすべてのイベント --}}
                            <tr>
                                <td class="text-blue-500 px-4 py-3">
                                    {{-- <a href="{{ route('events.show', ['event' => $event->id]) }}"> --}}
                                    <a href="{{ route('mypage.show', ['id' => $event['id']]) }}">
                                        {{-- キャンセル機能もつけたい --}}
                                        {{ $event['name'] }}
                                    </a>
                                </td>
                                {{-- <td class="px-4 py-3">{{ $event->start_date }}</td>
                                <td class="px-4 py-3">{{ $event->end_date }}</td> --}}
                                <td class="px-4 py-3">{{ $event['start_date'] }}</td>
                                <td class="px-4 py-3">{{ $event['end_date'] }}</td>
                                <td class="px-4 py-3">
                                    {{-- 今回は予約している情報しか取得していないので、if文事態が不要となる --}}
                                    {{-- @if(is_null($event->number_of_people))
                                        0
                                    @else --}}
                                        {{-- {{ $event->number_of_people }} --}}
                                        {{ $event['number_of_people'] }}
                                    {{-- @endif --}}
                                </td>
                                {{-- 今回は不要 --}}
                                {{-- <td class="px-4 py-3">{{ $event->max_people }} </td>
                                <td class="px-4 py-3">{{ $event->is_visible }} </td> --}}
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{-- {{ $events->links() }} --}}
                        {{-- コレクションだとこの状態でOKだが、連想配列ではうまく表示できない --}}
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>

    {{-- 過去のイベント
        今日以降のイベントをコピーして、編集する --}}
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="text-center py-2">
                    <h2>過去のイベント一覧</h2>
                </div>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-4 mx-auto">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- 今回はいらない --}}
                        {{-- <div class="flex justify-between">
                            <button onclick="location.href='{{ route('events.create')}}'" class="flex mb-4 ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</button>
                            <button onclick="location.href='{{ route('events.past')}}'" class="flex mb-4 ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">過去のイベント一覧</button>
                        </div> --}}

                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">イベント名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">開始日時</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">終了日時</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約人数</th>
                                {{-- 今回はいらない --}}
                                {{-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">定員</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">表示・非表示</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($events as $event) --}}
                            @foreach($pastEvents as $event)    {{--  ユーザーが予約しているすべてのイベント --}}
                            <tr>
                                <td class="text-blue-500 px-4 py-3">
                                    {{-- <a href="{{ route('events.show', ['event' => $event->id]) }}"> --}}
                                    <a href="{{ route('mypage.show', ['id' => $event['id']]) }}">
                                        {{-- キャンセル機能もつけたい --}}
                                        {{ $event['name'] }}
                                    </a>
                                </td>
                                {{-- <td class="px-4 py-3">{{ $event->start_date }}</td>
                                <td class="px-4 py-3">{{ $event->end_date }}</td> --}}
                                <td class="px-4 py-3">{{ $event['start_date'] }}</td>
                                <td class="px-4 py-3">{{ $event['end_date'] }}</td>
                                <td class="px-4 py-3">
                                    {{-- 今回は予約している情報しか取得していないので、if文事態が不要となる --}}
                                    {{-- @if(is_null($event->number_of_people))
                                        0
                                    @else --}}
                                        {{-- {{ $event->number_of_people }} --}}
                                        {{ $event['number_of_people'] }}
                                    {{-- @endif --}}
                                </td>
                                {{-- 今回は不要 --}}
                                {{-- <td class="px-4 py-3">{{ $event->max_people }} </td>
                                <td class="px-4 py-3">{{ $event->is_visible }} </td> --}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $events->links() }} --}}
                        {{-- コレクションだとこの状態でOKだが、連想配列ではうまく表示できない --}}
                        </div>
                    </div>
                    </section>
            </div>
        </div>
    </div>
</x-app-layout>


