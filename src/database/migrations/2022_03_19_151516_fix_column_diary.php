<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixColumnDiary extends Migration
{
    /**
     * 水位は削除する
     * 気温・水温にnull ableを追加
     * 開始日時・終了日時、季節、天気のnull ableを廃止
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->dropColumn('start_water_level');
            $table->dropColumn('end_water_level');

            $table->text('lowest_temperature')->nullable()->change();
            $table->text('highest_temperature')->nullable()->change();
            $table->text('lowest_water_temperature')->nullable()->change();
            $table->text('highest_water_temperature')->nullable()->change();

            $table->text('start_time')->nullable(false)->change();
            $table->text('end_time')->nullable(false)->change();
            $table->text('season')->nullable(false)->change();
            $table->text('weather')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->integer('start_water_level')->nullabke()->comment('開始時水位(cm)');
            $table->integer('end_water_level')->nullabke()->comment('終了時水位(cm)');

            $table->text('lowest_temperature')->nullable(false)->change();
            $table->text('highest_temperature')->nullable(false)->change();
            $table->text('lowest_water_temperature')->nullable(false)->change();
            $table->text('highest_water_temperature')->nullable(false)->change();

            $table->text('start_time')->nullable()->change();
            $table->text('end_time')->nullable()->change();
            $table->text('season')->nullable()->change();
            $table->text('weather')->nullable()->change();
        });
    }
}
