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

    
}
