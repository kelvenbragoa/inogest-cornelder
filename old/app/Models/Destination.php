<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function equipment(){
        return $this->hasMany('App\Models\Equipment', 'destination_id', 'id');
    }
}
