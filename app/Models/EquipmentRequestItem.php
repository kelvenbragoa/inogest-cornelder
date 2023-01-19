<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentRequestItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function equipment(){
        return $this->hasOne('App\Models\Equipment', 'id', 'equipment_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_operator_id');
    }

    public function scheduled_shift(){
        return $this->hasOne('App\Models\ScheduledShift', 'id', 'scheduled_shift_id');
    }

}
