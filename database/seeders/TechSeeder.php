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
        // 全ての技術分野のID取得
        $techFields = TechField::pluck('id')->all();

        // 技術分野毎に使用技術を二つ追加
        foreach ($techFields as $techField) {
            Tech::factory()->count(2)->create(['tech_field_id' => $techField]);
        }
    }
}
