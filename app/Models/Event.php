<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'information',
        'max_people',
        'start_date',
        'end_date',
        'is_visible',
    ];

    protected function eventDate(): Attribute
    {
        return new Attribute (
            get: fn () => Carbon::parse($this->start_date)->format('Y年m月d日'),
        );
    }

    protected function editEventDate(): Attribute
    {
        return new Attribute (
            get: fn () => Carbon::parse($this->start_date)->format('Y-m-d'),
        );
    }

    protected function startTime(): Attribute
    {
        return new Attribute (
            get: fn () => Carbon::parse($this->start_date)->format('H時i分'),
        );
    }

    protected function endTime(): Attribute
    {
        return new Attribute (
            get: fn () => Carbon::parse($this->end_date)->format('H時i分'),
        );
    }

    public function users()
    {
                                                // 第2引数で中間テーブル名を指定
        return $this->belongsToMany(User::class, 'reservations')
                    ->withPivot('id', 'number_of_people', 'canceled_date');
                            // withPivotで中間テーブル内の取得したい情報を指定
    }
}
