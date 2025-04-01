<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaryEntries extends Model
{
    protected $table = 'diary_entries';
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Categories::class);
    }
}
