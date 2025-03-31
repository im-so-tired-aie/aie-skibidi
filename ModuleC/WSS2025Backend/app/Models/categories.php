<?php

namespace App\Models;

use App\Models\criteria;
use App\Models\diary_entries;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'title',
        'created_at'
    ];
    //relationship to diary entry   
    public function diary_entries(){
        return $this->belongsTo(diary_entries::class,"category_id");
    }

    //relationship to criteria
    public function criteria(){
        return $this->hasOne(criteria::class,"category_id");
    }
}
