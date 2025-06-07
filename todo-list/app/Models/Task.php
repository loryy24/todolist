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
    ];

    public function category() {
      return $this->belongsTo(Category::class);
    }

}
