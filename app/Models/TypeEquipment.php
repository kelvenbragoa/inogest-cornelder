<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEquipment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function equipment(){
        return $this->hasMany('App\Models\Equipment', 'type_equipment_id', 'id');
    }
}
