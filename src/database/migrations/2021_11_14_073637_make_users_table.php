<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUsersTable extends Migration
{
    /**
     * usersテーブルを作成
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 200)->comment('ユーザーID');
            $table->string('user_name', 200)->comment('ユーザー名');
            $table->string('passward', 1000)->comment('パスワード');
            $table->timestamp('created')->comment('作成時間');
            $table->string('created_user_id', 200)->comment('作成者');
            $table->timestamp('modified')->comment('変更時間');
            $table->string('modified_user_id', 200)->comment('変更者');
            $table->softDeletes();
        });
    }

    /**
     * usersテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');   
    }
}
