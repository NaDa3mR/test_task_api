<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'in_progress', 'done'];
        $priority = ['low', 'medium', 'high'];

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement($status),
            'priority' => $this->faker->randomElement($priority),
            'due_date' => $this->faker->optional()->date(),
        ];
    }
}
