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
        $answers = [
            fake()->sentence(),
            fake()->sentence(),
            fake()->sentence(),
            fake()->sentence(),
        ];

        return [
            'question' => fake()->sentence(10), // Génère une question réaliste
            'anwsers' => json_encode($answers), // Réponses réalistes
            'good_answer' => rand(0, 3), // Index de la bonne réponse
            'id_quizz' => null, // Clé étrangère vers Quizz
        ];
    }
}
