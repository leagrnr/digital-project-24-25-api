<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $answers = ["answer1", "answer2", "answer3", "answer4"];

        return [
            'question' => fake()->word(),
            'anwsers' => json_encode($answers),
            'good_answer' => rand(0, 3),
            'id_quizz' => null,
        ];
    }
}
