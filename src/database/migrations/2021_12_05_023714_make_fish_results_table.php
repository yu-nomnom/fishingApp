<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFishResultsTable extends Migration
{
    /**
     * fish_resultsテーブルを作成
     * @return void
     */
    public function up()
    {
        Schema::create('fish_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('diary_id')->index()->comment('日記ID');
            $table->integer('point_id')->nullable()->comment('ポイントID');
            $table->integer('length')->nullabke()->comment('長さ(cm)');
            $table->integer('weight')->nullabke()->comment('重さ(g)');
            $table->string('lure', 200)->nullable()->comment('釣れたルアー');
            $table->time('catch_time')->nullable()->comment('釣れた時間');
            $table->timestamp('created')->comment('作成時間');
            $table->string('created_user_id', 200)->comment('作成者');
            $table->timestamp('modified')->comment('変更時間');
            $table->string('modified_user_id', 200)->comment('変更者');
            $table->softDeletes();
        });
    }

    /**
     * fish_resultsテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fish_results');
    }
}
