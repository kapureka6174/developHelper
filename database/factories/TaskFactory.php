<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "service_id" => Service::class,
            "taskname" => $this->faker->realText(10),
            "state" => $this->faker->randomElement(['やるべきこと', '開発中', '完了']),
            "time" => $this->faker->numberBetween(2,10),
        ];
    }
}
