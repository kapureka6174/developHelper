<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->all();
        $services = Service::pluck('id')->all();

        // 各サービスに二つのコメントを追加（ユーザーはランダム）
        foreach ($services as $service) {
            Comment::factory()->create(['user_id' => $users[array_rand($users)], 'service_id' => $service]);
            Comment::factory()->create(['user_id' => $users[array_rand($users)], 'service_id' => $service]);
        }
    }
}
