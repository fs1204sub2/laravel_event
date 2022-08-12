<div>
    <div class="text-center text-sm">
        日付を選択してください。本日から最大30日先まで選択可能です。
    </div>

    {{-- <input id="calendar" class="block mt-1 w-full"  mx-autoで中央揃えにしておく w-fullなら横幅一杯になる--}}
    <input id="calendar" class="block mt-1 mx-auto mb-2" {{-- mb-2を付け加える --}}
            type="text" name="calendar" value="{{ $currentDate }}"
            wire:change="getDate($event.target.value)" />

            <div class="flex border border-green-400 mx-auto">
                <x-calendar-time /> {{-- コンポーネント作成 仮で直書き コンポーネントクラスを使う場合は、CalendarTime.php（キャメルケース） --}}

                @for ($i = 0; $i < 7; $i++) {{-- @foreach ($currentWeek as $v) --}}
                    {{-- <x-day /> からコピー 7回繰り返す箇所の下--}}
                    <div class="w-32">
                        {{-- w-32でうまくいった --}}
                        <div class="py-1 px-2 border border-gray-200 text-center">
                            {{-- 日 --}}    {{-- 指定した日 --}}
                            {{-- {{ $v['day'] }} --}}
                            {{ $currentWeek[$i]['day'] }}
                        </div>
                        <div class="py-1 px-2 border border-gray-200 text-center">
                            {{-- 曜日 --}}  {{-- 指定した日の曜日 --}}
                            {{-- {{ $v['dayOfWeek'] }} --}}
                            {{ $currentWeek[$i]['dayOfWeek'] }}
                        </div>

                        @for($j = 0; $j < 21; $j++) {{-- 縦軸の21個の予定 --}}

                            @if($events->isNotEmpty())  {{-- 1つでもイベントがあれば、、、 --}}
                                                    {{-- DBのイベント開始日 時刻と、カレンダーの開始日 時刻が一致すれば --}}
                                @if(!is_null($events->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . \Constant::EVENT_TIME[$j]) ))
                                    @php
                                        $eventName = $events->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . \Constant::EVENT_TIME[$j])->name; // ①
                                        $eventInfo = $events->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . \Constant::EVENT_TIME[$j]); //②
                                        $eventPeriod = \Carbon\Carbon::parse($eventInfo->start_date)->diffInMinutes($eventInfo->end_date) / 30 - 1; // ③
                                                                    // 開始時刻のCarbonインスタンスを取れる     終了時刻との分単位の差分を取る
                                    @endphp

                                    {{-- ①{{ $events->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . \Constant::EVENT_TIME[$j])->name }}
                                    長いので、変数に格納する --}}
                                    <div class="py-1 px-2 border border-gray-200 text-center bg-blue-100">
                                                                    {{-- ②背景色をつける イベント名の部分に背景色がつく --}}
                                        {{ $eventName }}
                                    </div>

                                    @if ($eventPeriod > 0)  {{-- イベントが30分を超えるなら、、、 --}}
                                        @for($k = 0; $k < $eventPeriod; $k++) {{-- // $eventPeriod の数だけ背景色を作る --}}
                                            <div class="py-1 px-2 h-8 border border-gray-200 bg-blue-100"></div>
                                        @endfor
                                        @php
                                            $j += $eventPeriod // 作った背景色の分だけ $jを増やして、ループ処理をスキップする
                                            // @for($j = 0; $j < 21; $j++) は縦軸の30分ごとの変数
                                            // $eventPeriod の 数だけ <div class="py-1 px-2 h-8 border border-gray-200 bg-blue-100"></div>（背景色）を追加した
                                        @endphp
                                    @endif
                                @else {{-- DBのイベント開始日 時刻と、カレンダーの開始日 時刻が一致しなければ、、 --}}
                                    <div class="py-1 px-2 h-8 border border-gray-200"></div>
                                    {{-- 背景色なし --}}
                                @endif
                            @endif
                        @endfor
                    </div>
                @endfor

    {{-- @foreach ($events as $event)
        {{ $event->start_date }} <br>
    @endforeach --}}
</div>



