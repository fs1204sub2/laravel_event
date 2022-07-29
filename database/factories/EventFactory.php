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
        $dummyDate = $this->faker->dateTimeThisMonth;   // * 今月のダミーデータを作る DateTimeクラス

        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'max_people' => $this->faker->numberBetween(1,20),
            'start_date' => $dummyDate->format('Y-m-d H:i:s'),  // *の表示を変える DateTimeクラスなので、DateTimeクラスのメソッドが使える
            'end_date' => $dummyDate->modify('+1hour')->format('Y-m-d H:i:s'),
                                        // 現在時刻に+1時間
            'is_visible' => $this->faker->boolean
        ];
    }
}
