<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\ServiceTag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // タグを10個作成
        Tag::factory()->count(10)->create();

        // 中間テーブル（サービスとタグを結ぶ）にデータを追加
        $tags = Tag::pluck('id')->all();
        foreach ($tags as $tag) {
            ServiceTag::factory()->count(2)->create(['tag_id' => $tag]);
        }
    }
}
