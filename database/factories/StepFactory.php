<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Step>
 */
class StepFactory extends Factory
{
    /**
     * Return default attributes for a Step model used by the factory.
     *
     * The array contains:
     * - 'idea_id': a factory for an associated Idea model.
     * - 'description': a generated paragraph string.
     * - 'completed': `false` by default.
     *
     * @return array<string,mixed> Associative array of default Step attributes.
     */
    public function definition(): array
    {
        return [
            'idea_id' => Idea::factory(),
            'description' => fake()->paragraph(),
            'completed' => false,
        ];
    }
}
