<?php

namespace Database\Factories;

use App\Models\ServiceTag;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        /* 中間テーブルに紐付けるIDを取得する*/
        $serviceIDs  = Service::pluck('id')->all();
        $tagIDs  = Tag::pluck('id')->all();

        return [
            'service_id' => $this->faker->randomElement($serviceIDs), // ランダムでIDを選択
            'tag_id' => $this->faker->randomElement($tagIDs),  // ランダムでIDを選択
        ];
    }
}
