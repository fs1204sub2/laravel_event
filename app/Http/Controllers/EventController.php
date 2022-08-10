<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();

        $events = DB::table('events')   // クエリビルダでとる
        ->whereDate('start_date', '>=' , $today)
        ->orderBy('start_date', 'asc') // 開始日時順
        ->paginate(10); // 10件ずつ

        return view('manager.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $check =  EventService::checkEventDuplication(
            $request['event_date'],
            $request['start_time'],
            $request['end_time']
        );
        // $check = DB::table('events')
        // ->whereDate('start_date', $request['event_date'])       // 日にち
        // ->whereTime('end_date' , '>', $request['start_time'])
        //     // >= としてもいいが、準備や撤収などもあるため、今回は>
        // ->whereTime('start_date', '<', $request['end_time'])
        // ->exists(); // 存在確認

        // dd($check);
        // 過去の日は登録できなため一旦ddを外して登録後、重複しているか確認している

        if ($check) { // 存在したら
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return view('manager.events.create');
        }

        // 重複チュックにパスしたら、登録処理に入る。

        $startDate = EventService::joinDateAndTime($request['event_date'], $request['start_time']);
        $endDate = EventService::joinDateAndTime($request['event_date'], $request['end_time']);
        // $start = $request['event_date'] . ' ' . $request['start_time'];
        // $end = $request['event_date'] . ' ' . $request['end_time'];
        // $startDate = Carbon::createFromFormat('Y-m-d H:i', $start );
        // $endDate = Carbon::createFromFormat('Y-m-d H:i', $end );

        // dd($startDate, $endDate);
        // ^ Carbon\Carbon @1659236400 {#1500 ▼
        //     ...
        //     date: 2022-07-31 12:00:00.0 Asia/Tokyo (+09:00)
        //   }
        //   ^ Carbon\Carbon @1659240000 {#1497 ▼
        //     ...
        //     date: 2022-07-31 13:00:00.0 Asia/Tokyo (+09:00)
        //   }


        Event::create([
            'name' => $request['event_name'],
            'information' => $request['information'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'max_people' => $request['max_people'],
            'is_visible' => $request['is_visible'],
        ]);

        session()->flash('status', '登録okです');

        return to_route('events.index'); //名前付きルート
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;

        return view('manager.events.show', compact('event', 'eventDate', 'startTime', 'endTime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        // $eventDate = $event->eventDate;
        $eventDate = $event->editEventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;

        return view('manager.events.edit', compact('event', 'eventDate', 'startTime', 'endTime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $check =  EventService::checkEditEventDuplication(
            $event->id, $request['event_date'], $request['start_time'], $request['end_time']
        );

        if ($check) {
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            $eventDate = $event->editEventDate;
            $startTime = $event->startTime;
            $endTime = $event->endTime;
            return view('manager.events.edit', compact('event', 'eventDate', 'startTime', 'endTime'));
        }

        $startDate = EventService::joinDateAndTime($request['event_date'], $request['start_time']);
        $endDate = EventService::joinDateAndTime($request['event_date'], $request['end_time']);

        $event->name = $request['event_name'];
        $event->information = $request['information'];
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->max_people = $request['max_people'];
        $event->is_visible = $request['is_visible'];
        $event->save();

        session()->flash('status', '更新しました。');

        return to_route('events.index'); //名前付きルート
    }

    public function past()
    {
        $today = Carbon::today();   //今日の日付を取得
        // 今日の日付よりも前の情報だけを取得する。

        $events = DB::table('events')
                ->whereDate('start_date', '<', $today)
                ->orderBy('start_date', 'desc')
                ->paginate(10);

        return view('manager.events.past', compact('events'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }


}
