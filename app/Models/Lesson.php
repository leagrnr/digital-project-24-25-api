<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'id_categorie',
    ];

    public function idCategorie(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function lessonReadings()
    {
        return $this->hasMany(LessonReading::class, 'id_lesson');
    }
}
