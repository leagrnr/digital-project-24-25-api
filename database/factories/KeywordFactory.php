<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Keyword;
use App\Models\Lesson;

class KeywordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Keyword::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'keyword' => fake()->regexify('[A-Za-z0-9]{128}'),
            'id_lesson' => Lesson::factory(),
        ];
    }
}
