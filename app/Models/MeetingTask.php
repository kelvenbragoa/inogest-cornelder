<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingTask extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function participant(){
        return $this->hasOne('App\Models\MeetingParticipant', 'id', 'participant_meeting_id');
    }
}
