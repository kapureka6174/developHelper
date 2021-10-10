<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->rememberToken(); // ログアウトしない限り5年間ログイン状態を保持できる
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('google_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('github_account')->nullable();
            $table->string('fav_lang')->nullable();
            $table->string('dev_years')->nullable();
            $table->longText('introduction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
