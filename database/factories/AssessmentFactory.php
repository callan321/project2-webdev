<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'instruction' => $this->faker->paragraph(),
            'number_of_reviews' => $this->faker->numberBetween(1, 5),
            'max_score' => $this->faker->numberBetween(1, 100),
            'due_date' => $this->faker->date(),
            'due_time' => $this->faker->time(),
            'type' => $this->faker->randomElement(['student-select', 'teacher-assign']),
        ];
    }
}
