<?php

namespace Database\Factories;

use App\Models\TechField;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TechField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_id' => Service::factory(),
            'fieldname' => $this->faker->realText(10),
        ];
    }
}
