<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'due_date',
        'priority', // 1: haute, 2: moyenne, 3: basse
       
    ];

    public function category() {
      return $this->belongsTo(Category::class);
    }

}
