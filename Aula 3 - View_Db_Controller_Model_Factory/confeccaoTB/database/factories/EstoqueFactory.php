<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produto_id' => \App\Models\Produtos::inRandomOrder()->first()->id,
            'produto_name' => \App\Models\Produtos::factory()->name(),
            'qntd' => $this->faker->numberBetween(1, 100),
        ];
    }
}
