<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Requirement;
use App\Models\Tag;
use App\Models\Uri;
use App\Models\TechField;
use App\Models\Tech;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->has(Service::factory()->count(2))->create()->each(function ($service){
            Requirement::factory()->count(2)->create(['service_id' => $service->id]);
            Tag::factory()->count(2)->create(['service_id' => $service->id]);
            Uri::factory()->count(2)->create(['service_id' => $service->id]);
            TechField::factory()->count(2)->create(['service_id' => $service->id])->each( function ($techField){
                Tech::factory()->count(2)->create(['tech_field_id' => $techField->id]);
            });
        });
    }
}
