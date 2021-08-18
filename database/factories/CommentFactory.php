<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "service_id" => Service::class,
            "user_id" => User::class,
            "type" => $this->faker->randomElement(['質問', '感想', 'アドバイス']),
            "content" => $this->faker->realText(),
        ];
    }
}
