<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'rfc' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'owner' => $this->faker->name(),
        ];
    }
}
