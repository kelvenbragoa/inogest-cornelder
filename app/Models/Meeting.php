<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function participants(){
        return $this->hasMany('App\Models\MeetingParticipant', 'meeting_id', 'id');
    }

    public function tasks(){
        return $this->hasMany('App\Models\MeetingTask', 'meeting_id', 'id');
    }
}
