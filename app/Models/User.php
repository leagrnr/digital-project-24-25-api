<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
        'id_compagnie',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function compagnie(): BelongsTo
    {
        return $this->belongsTo(Compagny::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'id_user');
    }

    public function lessonReadings()
    {
        return $this->hasMany(LessonReading::class, 'id_user');
    }
}
