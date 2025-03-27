<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\About;
use App\Models\Lesson;
use App\Models\Quizz;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_lesson' => Lesson::factory(),
            'id_quizz' => Quizz::factory(),
        ];
    }
}
