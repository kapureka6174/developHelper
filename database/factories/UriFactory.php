<?php

namespace Database\Factories;

use App\Models\Uri;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class UriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Uri::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_id' => Service::factory(),
            'uri' => $this->faker->word(),
            'method' => $this->faker->word(),
            'explain' => $this->faker->realText(),
        ];
    }
}
