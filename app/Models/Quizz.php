<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;

    protected $table = 'quizz';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
