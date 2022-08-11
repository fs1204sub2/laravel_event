<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventService
{
    public static function checkEventDuplication($eventDate, $startTime, $endTime)
    {
        return DB::table('events')
                ->whereDate('start_date', $eventDate)
                ->whereTime('end_date', '>', $startTime)
                ->whereTime('start_date', '<', $endTime)
                ->exists();
    }


    public static function checkEditEventDuplication($ownEventId, $eventDate, $startTime, $endTime)
    {
        $events = DB::table('events')
                ->whereDate('start_date', $eventDate)
                ->whereTime('end_date', '>', $startTime)
                ->whereTime('start_date', '<', $endTime)
                ->get()
                ->toArray(); // コレクションを配列にする。

        // dd($events);
        // http://localhost/manager/events/105
        // ^ array:2 [▼
        // 0 => {#1536 ▼
        //     +"id": 101
        //     +"name": "dddd"
        //     +"information": "dddd"
        //     +"max_people": 1
        //     +"start_date": "2022-08-10 12:00:00"
        //     +"end_date": "2022-08-10 13:00:00"
        //     +"is_visible": 1
        //     +"created_at": "2022-07-31 13:03:30"
        //     +"updated_at": "2022-08-10 11:33:38"
        // }
        // 1 => {#1535 ▼
        //     +"id": 105
        //     +"name": "aa"
        //     +"information": "aaa"
        //     +"max_people": 1
        //     +"start_date": "2022-08-10 14:00:00"
        //     +"end_date": "2022-08-10 15:00:00"
        //     +"is_visible": 1
        //     +"created_at": "2022-08-10 11:35:27"
        //     +"updated_at": "2022-08-10 11:35:27"
        // }
        // ]

        $duplication = false;

        if (empty($events)) {
            return $duplication;
        }

        foreach ($events as $event) {
            if ($ownEventId !== $event->id) {  // 重複していたイベントが自身と違う場合、イベントの重複が存在する。
                $duplication = true;
            }
        }

        // dd($duplication);   // true  違うイベントidと重複があるので、trueとなる

        return $duplication;
    }


    public static function joinDateAndTime($date, $time)
    {
        $join = $date . ' ' . $time;
        return Carbon::createFromFormat('Y-m-d H:i', $join);
    }

    public static function getWeekEvents($startDate, $endDate)
    {
        // index()からコピーして、編集
        $reservedPeople = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        return DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople', function($join){
                $join->on('events.id', '=', 'reservedPeople.event_id');
            })
        // ->whereDate('events.start_date', '>=' , $today)
        ->whereBetween('events.start_date', [$startDate, $endDate])
        ->orderBy('events.start_date', 'asc')
        // ->paginate(10);
        ->get();
    }
}
