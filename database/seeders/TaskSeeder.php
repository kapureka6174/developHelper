<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Task;

class TaskSeeder extends Seeder
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

        // 各サービスにタスクを二つ追加
        foreach ($services as $service) {
            Task::factory()->count(2)->create(['service_id' => $service]);
        }
    }
}
