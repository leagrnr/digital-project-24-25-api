<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(), // Relation avec User
            'id_question' => Question::factory(), // Relation avec Question
            'score' => fake()->numberBetween(0, 100), // Score réaliste
        ];
    }
}
