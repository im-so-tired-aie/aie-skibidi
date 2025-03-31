<?php

namespace App\Models;

use App\Models\programmes;
use Illuminate\Database\Eloquent\Model;
use App\Models\diary_entries;
class enrolments extends Model
{
    //relationship to user
    protected $fillable = [
        'name',
        'user_id',
        'nric',
        'address',
        'contact_no',
        'dob',
        'gender',
        'nationality',
        'email',
        'race',
        'updated_at',
        'programme_id',
        'created_at'
    ];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    //relationship to programme
    public function programmes(){
        return $this->hasOne(programmes::class,"programme_id");
    }

    //relationship to diary_entries
    public function diary_entries(){
        return $this->hasMany(diary_entries::class,"enrolment_id");
    }

}
