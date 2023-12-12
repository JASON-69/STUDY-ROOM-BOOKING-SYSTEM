<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'purpose',
        'brief_description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'booking_status',
        'user_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function startDateTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Carbon::parse($this->start_date->format('Y-m-d') . ' ' . $this->start_time->format('H:i:s'));
            }
        );
    }

    public function endDateTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Carbon::parse($this->end_date->format('Y-m-d') . ' ' . $this->end_time->format('H:i:s'));
            }
        );
    }

    public function date(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->start_date == $this->end_date
                    ? $this->start_date->format('Y-m-d')
                    : $this->start_date->format('Y-m-d') . ' - ' . $this->end_date->format('Y-m-d');
            }
        );
    }
    public function startbydate(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->start_date->format('Y-m-d');
            }
        );
    }

    public function time(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
            }
        );
    }
}
