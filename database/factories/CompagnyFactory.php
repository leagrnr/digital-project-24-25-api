<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Compagny;

class CompagnyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compagny::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'logo' => fake()->regexify('[A-Za-z0-9]{512}'),
            'siret' => fake()->regexify('[A-Za-z0-9]{18}'),
            'mail_manager' => fake()->regexify('[A-Za-z0-9]{50}'),
            'telephone_manager' => fake()->regexify('[A-Za-z0-9]{16}'),
            'adresse_siege' => fake()->regexify('[A-Za-z0-9]{124}'),
        ];
    }
}
