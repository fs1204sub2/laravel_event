<?php

namespace App\Http\Livewire;

use App\Services\EventService;
use Carbon\CarbonImmutable;
use Livewire\Component;

class Calendar extends Component
{
    public $currentDate;
    public $day;
    public $checkDay; // 日付判定用 $dayで日付を取っていたので、この下あたりにする
    public $dayOfWeek; // 曜日も動的に変化させたい
    public $currentWeek;
    public $sevenDaysLater;
    public $events;

    public function mount()
    {
        $this->currentDate = CarbonImmutable::today();
        $this->sevenDaysLater = $this->currentDate->addDay(7);
        $this->currentWeek = [];    // 今日から7日分の日付を表示したい

        $this->events = EventService::getWeekEvents(
            $this->currentDate->format('Y-m-d'),
            $this->sevenDaysLater->format('Y-m-d')
        ); // 2つの日付の間のイベントを取得できる

        for ($i = 0; $i < 7; $i++) {
            $this->day = CarbonImmutable::today()->addDay($i)->format('m月d日');
            $this->checkDay = CarbonImmutable::today()->addDays($i)->format('Y-m-d');   // 日付判定用のformatとして使うことができる。
            $this->dayOfWeek = CarbonImmutable::today()->addDays($i)->dayName; // dayName で曜日を取得できる

            // $this->currentWeek[] = $this->day;
            $this->currentWeek[] = [
                'day' => $this->day,                // カレンダー表示用 (○月△日)
                'checkDay' => $this->checkDay,      // イベントの判定用 (○○○○-△△-□□)
                'dayOfWeek' => $this->dayOfWeek     // 曜日
            ];
        }
    }

    public function getDate($date)
    {
        $this->currentDate = $date; //文字列
        $this->currentWeek = [];
        $this->sevenDaysLater = CarbonImmutable::parse($this->currentDate)->addDay(7);

        $this->events = EventService::getWeekEvents(
            $this->currentDate, // currentDateは文字列なのでformatは不要
            $this->sevenDaysLater->format('Y-m-d')
        ); // 2つの日付の間のイベントを取得できる

        for ($i = 0; $i < 7; $i++ ) {
            $this->day = CarbonImmutable::parse($this->currentDate)->addDay($i)->format('m月d日');
            $this->checkDay = CarbonImmutable::parse($this->currentDate)->addDay($i)->format('Y-m-d');
            $this->dayOfWeek = CarbonImmutable::parse($this->currentDate)->addDay($i)->dayName;

            // $this->currentWeek[] = $this->day;
            $this->currentWeek[] = [
                'day' => $this->day,                // カレンダー表示用 (○月△日)
                'checkDay' => $this->checkDay,      // イベントの判定用 (○○○○-△△-□□)
                'dayOfWeek' => $this->dayOfWeek     // 曜日
            ];
        }
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
