<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class About extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_lesson',
        'id_quizz',
    ];

    public function idLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function idQuizz(): BelongsTo
    {
        return $this->belongsTo(Quizz::class);
    }
}
