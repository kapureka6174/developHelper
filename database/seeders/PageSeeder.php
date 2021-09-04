<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Page;
use App\Models\Requirement;
use App\Models\RequirementPage;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = Service::pluck('id')->all();
        foreach ($services as $service) {
            Page::factory()->count(2)->create(['service_id' => $service]);
        }

        foreach ($services as $service) {
            $pages = Page::where('service_id', $service)->get('id');
            $requirements = Requirement::where('service_id', $service)->get('id');
            foreach ($pages as $index => $page) {
                if ($index % 2 == 0) {
                    RequirementPage::factory()->create(['page_id' => $page,  'requirement_id' => $requirements[0]]);
                } else {
                    foreach ($requirements as $requirement) {
                        RequirementPage::factory()->create(['page_id' => $page,  'requirement_id' => $requirement]);
                    }
                }
            }
        }
    }
}
