<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $dummyDate = $this->faker->dateTimeThisMonth;   // * 今月のダミーデータを作る DateTimeクラス

        $availableHour = $this->faker->numberBetween(10, 18); //10時~18時
        $minutes = [0, 30]; // 00分か 30分
        $mKey = array_rand($minutes); //ランダムにキーを取得
        $addHour = $this->faker->numberBetween(1, 3); // イベント時間 1時間~3時間

        $dummyDate = $this->faker->dateTimeThisMonth; // 今月分をランダムに取得
        $startDate = $dummyDate->setTime($availableHour, $minutes[$mKey]);
        $clone = clone $startDate; // そのままmodifyするとstartDateも変わってしまう
        $endDate = $clone->modify('+'.$addHour.'hour');

        // dd($startDate, $endDate);

        // root@c32a5deee503:/var/www/html# php artisan migrate:fresh --seed
        // ...
        // ^ DateTime @1658136600 {#1998
        //      date: 2022-07-18 18:30:00.0 Asia/Tokyo (+09:00)
        // }
        // ^ DateTime @1658143800 {#2000
        //      date: 2022-07-18 20:30:00.0 Asia/Tokyo (+09:00)
        // }

        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'max_people' => $this->faker->numberBetween(1,20),
            // 'start_date' => $dummyDate->format('Y-m-d H:i:s'),  // *の表示を変える DateTimeクラスなので、DateTimeクラスのメソッドが使える
            // 'end_date' => $dummyDate->modify('+1hour')->format('Y-m-d H:i:s'), // 現在時刻に+1時間
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_visible' => $this->faker->boolean
        ];
    }
}
