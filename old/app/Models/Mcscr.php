<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcscr extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function equipment(){
        return $this->hasOne('App\Models\Equipment', 'id', 'equipment_id');
    }
}
