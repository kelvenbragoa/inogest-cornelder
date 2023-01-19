<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledShift extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function shift(){
        return $this->hasOne('App\Models\Shift', 'id', 'shift_id');
    }


    public function supervisor_1(){
        return $this->hasOne('App\Models\User', 'id', 'supervisor_1_id');
    }

    public function supervisor_2(){
        return $this->hasOne('App\Models\User', 'id', 'supervisor_2_id');
    }


    
}
