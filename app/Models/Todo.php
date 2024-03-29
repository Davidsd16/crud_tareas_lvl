<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * Define la relación "belongsTo" con la categoría.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    protected $fillable = ['title', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


