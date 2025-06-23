<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Lesson;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3), // Génère un nom réaliste
            'content' => '<h1>' . fake()->sentence(4, true) . '</h1><p>' . fake()->paragraph() . '</p><ul><li>' . fake()->sentence() . '</li><li>' . fake()->sentence() . '</li></ul> <h2>' . fake()->sentence(4, true) . '</h2> <p>' . fake()->paragraph(10, true) . '</p>', // Génère du contenu HTML réaliste
            'id_categorie' => Category::factory(),
        ];
    }
}
