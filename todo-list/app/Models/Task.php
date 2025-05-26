<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description',
        'due_date',
    ];

    public function category() {
        $this->belongsTo(Category::class);
    }
   
    public function user() {
        $this->belongsTo(User::class);
    }

}
