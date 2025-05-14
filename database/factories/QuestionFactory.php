<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Quizz;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'question' => fake()->word(),
            'anwsers' => '["answer1", "answer2", "answer3", "answer4"]',
            'good_answer' => fake()->randomElement(['answer1', 'answer2', 'answer3', 'answer4']),
            'id_quizz' => Quizz::factory(),
        ];
    }
}
