<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public $name = '';

    public function mount()
    {
        $this->name = 'mount';
        // ページを読み込んでrender()でviewファイルが表示される前に、mountの中の処理が実行される。
        // mountという文字が初期値として入ってくる。
    }

    public function updated() // データ更新毎に呼び出される リアルタイムバリデーションなどに使われる
    {
        $this->name = 'updated';

        // <input wire:model.defer="name" type="text">  のときは、submitしてからデータが更新される
        // <input wire:model="name" type="text"> のときは、文字が入力されるたびにupdatedが走る
    }



    public function mouseOver()
    {
        $this->name = 'mouseover';
    }


    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
