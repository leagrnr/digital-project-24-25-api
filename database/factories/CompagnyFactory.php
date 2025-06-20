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
            'name' => fake()->company(),
            'logo' => fake()->imageUrl(600, 400, 'business', true, 'logo'), // Génère une URL réaliste pour le logo
            'siret' => fake()->numerify('###########'),
            'mail_manager' => fake()->companyEmail(), // Génère un email réaliste
            'telephone_manager' => fake()->phoneNumber(),
            'adresse_siege' => fake()->address(),
        ];
    }
}
