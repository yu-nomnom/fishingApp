<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * 水位と釣果IDは削除する
 * 気温・水温にnull ableを追加
 * 開始日時・終了日時、季節、天気のnull ableを廃止
 * (mysqlの独自のデータ型であるtimestampはlaravelのmigrationで対応していない)
 */
class FixColumnDiary extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->dropColumn('start_water_level');
            $table->dropColumn('end_water_level');
            $table->dropColumn('fish_result_id');

            $table->integer('lowest_temperature')->nullable()->change();
            $table->integer('highest_temperature')->nullable()->change();
            DB::statement('ALTER TABLE diaries MODIFY lowest_water_temperature DOUBLE(3,1) COMMENT "最低水温"');
            DB::statement('ALTER TABLE diaries MODIFY highest_water_temperature DOUBLE(3,1) COMMENT "最高水温"');

            DB::statement('ALTER TABLE `diaries` MODIFY COLUMN `start_time` TIMESTAMP;');
            DB::statement('ALTER TABLE `diaries` MODIFY COLUMN `end_time` TIMESTAMP;');
            $table->text('season')->nullable(false)->change();
            $table->text('weather')->nullable(false)->change();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->integer('start_water_level')->nullabke()->comment('開始時水位(cm)');
            $table->integer('end_water_level')->nullabke()->comment('終了時水位(cm)');
            $table->integer('fish_result_id')->index()->comment('釣果ID');

            $table->integer('lowest_temperature')->nullable(false)->change();
            $table->integer('highest_temperature')->nullable(false)->change();
            $table->integer('lowest_water_temperature')->nullable(false)->change();
            $table->integer('highest_water_temperature')->nullable(false)->change();

            DB::statement('ALTER TABLE `diaries` MODIFY COLUMN `start_time` TIMESTAMP NULL;');
            DB::statement('ALTER TABLE `diaries` MODIFY COLUMN `end_time` TIMESTAMP NULL;');
            $table->string('weather')->nullable()->change();
        });
    }
}
