<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Requirement;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全サービスのIDを取得
        $services = Service::pluck('id')->all();

        // 各サービスに機能を二つずつ追加
        foreach ($services as $service) {
            Requirement::factory()->count(2)->create(['service_id' => $service]);
        }
    }
}
