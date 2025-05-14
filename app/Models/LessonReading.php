<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Lesson;
use App\Models\User;

class LessonReading extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_readings';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_lesson',
        ];

    public function idLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
