<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDiaryTable extends Migration
{
    /**
     * diariesテーブルを作成
     * @return void
     */
    public function up()
    {
        //気温・水温は摂氏度とする
        Schema::create('diaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 200)->comment('タイトル');
            $table->integer('field_id')->index()->comment('釣り場ID');
            $table->integer('fish_result_id')->index()->comment('釣果ID');
            $table->timestamp('start_time')->nullable()->comment('釣り開始時間');
            $table->timestamp('end_time')->nullable()->comment('釣り終了時間');
            $table->string('season', 50)->nullable()->comment('季節');
            $table->string('weather', 50)->nullable()->comment('天気');
            $table->integer('lowest_temperature')->nullabke()->comment('最低気温');
            $table->integer('highest_temperature')->nullabke()->comment('最高気温');
            $table->integer('lowest_water_temperature')->nullabke()->comment('最低水温');
            $table->integer('highest_water_temperature')->nullabke()->comment('最高水温');
            $table->integer('start_water_level')->nullabke()->comment('開始時水位(cm)');
            $table->integer('end_water_level')->nullabke()->comment('終了時水位(cm)');
            $table->string('tide', 50)->nullabke()->comment('潮(大潮〜小潮まで)');
            $table->boolean('competition_flg')->default(false)->comment('試合フラグ');
            $table->timestamp('created')->comment('作成時間');
            $table->string('created_user_id', 200)->comment('作成者');
            $table->timestamp('modified')->comment('変更時間');
            $table->string('modified_user_id', 200)->comment('変更者');
            $table->softDeletes();
        });
    }

    /**
     * diaryテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
