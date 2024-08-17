<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->word;
        $slug=str_replace(" ","-",strtolower($name));
        return [
            "name" => ucfirst($this->faker->word),
            "slug" => $slug,
            "photo" =>  $this->faker->imageUrl(250, 250, 'products', true, 'Faker')
        ];
    }
}
