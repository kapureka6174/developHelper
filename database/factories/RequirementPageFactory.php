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
        return [
            'requirement_id' => Requirement::class,
            'page_id' => Page::class,
        ];
    }
}
