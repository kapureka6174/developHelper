<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全ユーザーのIDを取得
        $users = User::pluck('id')->all();

        // 各ユーザーに二つのサービスを追加
        foreach ($users as $user) {
            Service::factory()->count(2)->create(['user_id' => $user]);
        }
    }
}
