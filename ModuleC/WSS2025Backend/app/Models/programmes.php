<?php

namespace App\Models;

use App\Models\criteria;
use Illuminate\Database\Eloquent\Model;

class programmes extends Model
{
    protected $fillable = [
        'title',
        'created_at'
    ];
    //relationship to enrolments
    public function enrolments(){
        return $this->belongsToMany(enrolments::class,'programme_id');
    }

    //relationship to crietria
    public function criteria(){
        return $this->hasOne(criteria::class,"programme_id");
    }
}
