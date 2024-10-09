<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\JobLevel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::inRandomOrder()->value('id'),
            'name' => fake()->name(),
            'amount' => random_int(1, 10),
            'level' => JobLevel::inRandomOrder()->value('id'),
            'description' => fake()->text(200),
            'requirements' => fake()->text(200),
            'benefits' => fake()->text(200),
            'status' => 1,
            'salary_min' => random_int(7000000, 10000000),
            'salary_max' => random_int(10000000, 30000000),
            'negotiable' => $this->faker->boolean(),
            'end_date' => fake()->date(),
        ];
    }
}
