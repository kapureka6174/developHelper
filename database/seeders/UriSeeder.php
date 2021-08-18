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
        $services = Service::pluck('id')->all();

        foreach ($services as $service) {
            Uri::factory()->count(2)->create(['service_id' => $service]);
        }
    }
}
