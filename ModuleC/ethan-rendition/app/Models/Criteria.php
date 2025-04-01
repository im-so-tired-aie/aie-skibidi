<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Categories::class);
    }

    public function programme() {
        return $this->belongsTo(Programmes::class);
    }
}
