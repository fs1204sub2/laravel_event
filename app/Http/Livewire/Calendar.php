<?php

namespace App\Http\Livewire;

use App\Services\EventService;
// use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Livewire\Component;

class Calendar extends Component
{
    public $currentDate;
    public $day;
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
            $this->currentWeek[] = $this->day;
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
            $this->currentWeek[] = $this->day;
        }
    }


    public function render()
    {
        return view('livewire.calendar');
    }
}
