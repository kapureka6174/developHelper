<?php

namespace Database\Factories;

use App\Models\RequirementPage;
use App\Models\Requirement;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequirementPageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequirementPage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /* 中間テーブルに紐付けるIDを取得する*/
        $requirementIDs  = Requirement::pluck('id')->all();
        $pageIDs  = Page::pluck('id')->all();

        return [
            'requirement_id' => $this->faker->randomElement($requirementIDs), // ランダムでIDを選択
            'page_id' => $this->faker->randomElement($pageIDs),  // ランダムでIDを選択
        ];
    }
}
