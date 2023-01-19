<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquimentRequest extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function scheduled_shift(){
        return $this->hasOne('App\Models\ScheduledShift', 'id', 'scheduled_shift_id');
    }

    public function type_equipment(){
        return $this->hasOne('App\Models\TypeEquipment', 'id', 'type_equipment_id');
    }

    
}
