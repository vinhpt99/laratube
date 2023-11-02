<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chanel_id' => function() {
                return  \App\Chanel::factory()->create()->id;
            },
            'views' => $this->faker->numberBetween(1, 1000),
            'thumbnail' => $this->faker->imageUrl(),
            'percentage' => 100,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'path' => $this->faker->word()
            //
        ];
    }
}
