<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全ユーザーとサービスのIDを取得
        $users = User::pluck('id')->all();
        $services = Service::pluck('id')->all();

        // 各サービスに二つのコメントを追加（ユーザーはランダム）
        foreach ($services as $service) {
            Like::factory()->create(['user_id' => $users[array_rand($users)], 'service_id' => $service]);
            Like::factory()->create(['user_id' => $users[array_rand($users)], 'service_id' => $service]);
            Like::factory()->create(['user_id' => $users[array_rand($users)], 'service_id' => $service]);
        }
    }
}
