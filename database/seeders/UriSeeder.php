<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Uri;

class UriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全サービスのIDを追加
        $services = Service::pluck('id')->all();

        // 各サービスにURI設計を二つ追加
        foreach ($services as $service) {
            Uri::factory()->count(2)->create(['service_id' => $service]);
        }
    }
}
