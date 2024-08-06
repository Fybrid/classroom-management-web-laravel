<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function rooms(){
        return $this->hasOne(Room::class, 'id');
    }

    protected $appends = ['period_name'];

    public function getPeriodNameAttribute(){
        return config('constant.room_period')[$this->period]['name'];
    }

    protected $fillable = ['personal_id','room_id','date','period']; 
    // protected $guarded = ['personal_id']; 
}
