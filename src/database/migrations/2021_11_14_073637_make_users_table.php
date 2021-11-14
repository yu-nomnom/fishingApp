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
            $table->string('user_id', 200);
            $table->string('user_name', 200);
            $table->timestamp('created');
            $table->string('created_user_id');
            $table->timestamp('modified');
            $table->string('modified_user_id');
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
