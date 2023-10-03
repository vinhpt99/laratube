<?php

namespace Database\Factories;

use App\Chanel;
use App\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User as AuthUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ChanelFactory extends Factory
{
    /**
       
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Chanel::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'user_id' => function() {
                return  \App\User::factory()->create()->id;
            },
            'description' => $this->faker->sentence(30)
            //
        ];
    }
}
