<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_question',
        'score',
    ];

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function idQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
