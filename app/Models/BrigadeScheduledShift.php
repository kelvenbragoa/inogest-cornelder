<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrigadeScheduledShift extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function brigade(){
        return $this->hasOne('App\Models\Brigade', 'id', 'brigade_id');
    }

    

    
}
