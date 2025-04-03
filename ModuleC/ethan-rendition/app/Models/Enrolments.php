<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrolments extends Model
{
    protected $guarded = [];

    function user() {
        return $this->belongsTo(User::class);
    }

    function diaries() {
        return $this->hasMany(DiaryEntries::class, 'enrolment_id');
    }

    function program() {
        return $this->belongsTo(Programmes::class, 'programme_id');
    }
}
