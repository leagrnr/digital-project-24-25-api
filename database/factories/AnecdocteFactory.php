<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Anecdocte;

class AnecdocteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anecdocte::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->catchPhrase(), // Génère un titre réaliste
            'content' => fake()->text(500), // Génère un contenu réaliste
        ];
    }
}
