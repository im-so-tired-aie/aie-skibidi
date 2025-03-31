<?php

namespace App\Models;

use App\Models\categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class diary_entries extends Model
{

    protected $fillable = [
        'title',
        'description',
        'organization',
        'reflection',
        'status',
        'start_date',
        "end_date",
        "hours",
        "remarks",
        "enrolment_id",
        "category_id",
        "created_at"
    ];

    //realtionship to category
    public function category(){
        return $this->hasOne(categories::class,"category_id");
    }

    //relationship with enrolments
    public function enrolments(){
        return $this->belongsTo(enrolments::class,"enrolment_id");
    }
}


