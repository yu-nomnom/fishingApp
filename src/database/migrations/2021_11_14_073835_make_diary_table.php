<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDiaryTable extends Migration
{
    /**
     * diaryテーブルを作成
     * @return void
     */
    public function up()
    {
        Schema::create('diary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('field_id')->nullable()->index();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('weather')->nullable();
            $table->integer('max_size')->nullable();
            $table->integer('catch_number')->nullable();
            $table->boolean('competition_flg')->default(false);
            $table->timestamp('created');
            $table->string('created_user_id');
            $table->timestamp('modified');
            $table->string('modified_user_id');
            $table->softDeletes();
        });
    }

    /**
     * diaryテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary');
    }
}
