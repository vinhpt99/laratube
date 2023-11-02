<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Comment::class;
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence(6),
            'user_id' => function() {
                return  \App\User::factory()->create()->id;
            },
            'video_id' => function() {
                return  \App\Video::factory()->create()->id;
            },
            'comment_id' => null

        ];
    }
}
