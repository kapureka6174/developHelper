<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TechField;
use App\Models\Tech;

class TechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techFields = TechField::pluck('id')->all();

        foreach ($techFields as $techField) {
            Tech::factory()->count(2)->create(['tech_field_id' => $techField]);
        }
    }
}
