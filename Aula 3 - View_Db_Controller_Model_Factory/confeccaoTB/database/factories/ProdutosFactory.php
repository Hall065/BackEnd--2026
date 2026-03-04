<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fornecedores;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'descricao' => $this->faker->text(),
            'preco' => $this->faker->randomFloat(2, 10, 1000),
            'fornecedor_id' => Fornecedores::factory(),
            'ativo' => $this->faker->boolean(),
        ];
    }
}
