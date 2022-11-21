<?php

namespace Database\Factories;

use App\Models\Emdad\Categories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Categories::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'aproved' => rand(0, 1),
            'isleaf' => rand(0, 1),
            'parent_id' => rand(0, 1),
            'company_id' => rand(1, 10),
        ];
    }
}
