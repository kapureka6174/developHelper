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
use App\Models\Task;
use App\Models\Comment;
use App\Models\Page;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを10人追加
        User::factory()->count(10)->create();
    }
}
