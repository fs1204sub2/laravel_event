<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Services\MyPageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $events = $user->events; // ユーザーに紐づいたイベント  ユーザーが予約しているイベント一覧を取得
                        // コードが長くなるためサービスを作る
        $fromTodayEvents = MyPageService::reservedEvent($events, 'fromToday');  // 今日以降のイベント一覧
        $pastEvents = MyPageService::reservedEvent($events, 'past');            // 過去のイベント一覧
        // 「今日以降」 と 「過去」 というのを指定できるように、引数に文字列を渡す。
        // dd($user, $events, $fromTodayEvents, $pastEvents);

        return view('mypage.index', compact('fromTodayEvents', 'pastEvents'));
    }

    
    // created_atが最新の情報を取得
    // 現在、同じユーザーが同じイベントを何回でも予約できるようになっているので、後ほど対策
    public function show($id)
    {
        $event = Event::findOrFail($id);

        // 詳細情報で予約人数を表示させたいので、中間テーブルから情報を取ってくる
        // ログインしているユーザーかつ渡ってきたevent_id
        $reservation = Reservation::where('user_id', '=', Auth::id())
        ->where('event_id', '=', $id)
        ->latest() // created_atが新しい順
        ->first();

        // dd($reservation);
        return view('mypage.show', compact('event', 'reservation'));
    }
    // cancelメソッドにも同じように latest()を追加しておく


    public function cancel($id)
    {
        $reservation = Reservation::where('user_id', '=', Auth::id())
        ->where('event_id', '=', $id)
        ->latest()
        ->first();
            // 中間テーブルでuser_idとevent_id でデータを指定 後ほど予約済みのイベントは予約できないようにするので、これで一意に指定できる

        $reservation->canceled_date = Carbon::now()->format('Y-m-d H:i:s');
        $reservation->save();

        session()->flash('status', 'キャンセルできました。');
        return to_route('dashboard');
    }
}
