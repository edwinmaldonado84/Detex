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
            'business_name' => $this->faker->company(),
            'rfc' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'webpage' => $this->faker->safeEmailDomain(),
            'observations' => $this->faker->sentence(10, true),
            'group_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
