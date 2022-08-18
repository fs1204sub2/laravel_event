<?php

namespace App\Services;

use Carbon\Carbon;

class MyPageService {

    public static function reservedEvent($events, $string)
    {
        $reservedEvents = [];   // 事前に空の配列を作って、そこにイベント情報を追加していく。
        if ($string === 'fromToday') {
                    // $eventsがid順になっているsortByでstart_dateの昇順にする
            foreach($events->sortBy('start_date') as $event) { // 昇順
                        // キャンセルでないものを取る   &&   イベントの開始日時が今日以降                 datetime型に合わせる
                if (is_null($event->pivot->canceled_date) && $event->start_date >= Carbon::now()->format('Y-m-d 00:00:00')) {
                    $eventInfo = [
                        'id' => $event->id,
                        'name' => $event->name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->end_date,
                        'number_of_people' => $event->pivot->number_of_people,
                    ];
                    $reservedEvents[] = $eventInfo;
                }
            }
        }

        if ($string === 'past') {
            foreach($events->sortByDesc('start_date') as $event) { // 降順
            // foreach($events->orderBy('start_date', 'desc') as $event) { // 降順
                // Method Illuminate\Database\Eloquent\Collection::orderBy does not exist.
                if (is_null($event->pivot->canceled_date) && $event->start_date < Carbon::now()->format('Y-m-d 00:00:00')) {
                    $eventInfo = [
                        'id' => $event->id,
                        'name' => $event->name,
                        'start_date' => $event->start_date,
                        'end_date' => $event->end_date,
                        'number_of_people' => $event->pivot->number_of_people,
                    ];
                    $reservedEvents[] = $eventInfo;
                }
            }
        }

        return $reservedEvents;
    }
}
