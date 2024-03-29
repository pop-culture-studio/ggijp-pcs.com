<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'file' => $this->faker->url(),
            'title' => $this->faker->text(),
            'author' => $this->faker->name(),
            'description' => $this->faker->text(),
        ];
    }
}
