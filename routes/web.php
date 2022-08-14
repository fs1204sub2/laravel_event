<?php

use App\Http\Controllers\AlpineTestController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LivewireTestController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('calendar');
});

Route::prefix('manager')->middleware('can:manager-higher')->group(function(){
                                    //認可ルールを通過したらルーティングの処理が走る
    Route::get('index', function () {
        dd('manager');
    });
});

Route::middleware('can:user-higher')->group(function(){
    Route::get('/dashboard', [ReservationController::class, 'dashboard' ])->name('dashboard');
    Route::get('/{id}', [ ReservationController::class, 'detail' ] )->name('events.detail');
    Route::post('/{id}', [ ReservationController::class, 'reserve' ] )->name('events.reserve');
});


Route::prefix('manager')
->middleware('can:manager-higher')->group(function(){
    Route::get('events/past', [EventController::class, 'past'])->name('events.past');
    Route::resource('events', EventController::class);
});


// Route::controller(LivewireTestController::class)->prefix('livewire-test')->group(function(){
//     Route::get('index', 'index')->name('liviwire-test.index');
//     Route::get('register', 'register')->name('liviwire-test.register');
// });

Route::controller(LivewireTestController::class)->prefix('livewire-test')->name('livewire-test.')->group(function(){
    Route::get('index', 'index')->name('index');
    Route::get('register', 'register')->name('register');
});


Route::get('alpine-test/index', [AlpineTestController::class, 'index']);

