<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    public function definition(): array
    {
        $elements = ['Geo', 'Pyro', 'Hydro', 'Cryo', 'Electro', 'Dendro', 'Anemo'];
        $weapons  = ['Sword', 'Claymore', 'Polearm', 'Bow', 'Catalyst'];
        $regions  = ['Mondstadt', 'Liyue', 'Inazuma', 'Sumeru', 'Fontaine', 'Natlan', 'Snezhnaya'];

        $element = $this->faker->randomElement($elements);
        $name    = $this->faker->firstName();
        $slug    = strtolower(str_replace(' ', '-', $name));

        return [
            'name'          => $name,
            'constellation' => $this->faker->words(2, true),
            'element'       => $element,
            'weapon'        => $this->faker->randomElement($weapons),
            'region'        => $this->faker->randomElement($regions),
            'stars'         => $this->faker->randomElement([4, 5]),
            'playstyle'     => $this->faker->sentence(4),
            'mechanics'     => $this->faker->sentence(12),
            'affiliation'   => $this->faker->company(),
            'image_url'     => "https://genshin.jmp.blue/characters/{$slug}/portrait",
        ];
    }
}
