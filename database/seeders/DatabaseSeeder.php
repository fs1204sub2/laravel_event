<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ReservationはUser, Eventそれぞれに紐づくので、事前にEvent, Userを作った上で、Reservationのダミーデータが入るようにする

        Event::factory(100)->create();
        
        $this->call([
            UserSeeder::class,
            ReservationSeeder::class
        ]);
    }
}
