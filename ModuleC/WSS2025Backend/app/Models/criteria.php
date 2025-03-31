<?php

namespace App\Models;

use App\Models\categories;
use App\Models\programmes;
use Illuminate\Database\Eloquent\Model;

class criteria extends Model
{
    protected $table = 'criteria';
    protected $fillable = [
        'category_id',
        'programme_id',
        'required_hours',
        'required_duration',
        'required_project',
        'created_at',
    ];

    // relationship to category
    public function category(){
        return $this-> belongsTo(categories::class,"category_id");
    }
     // relationship to programmes
     public function programmes(){
        return $this->belongsTo(programmes::class,"programme_id");
     }
}
