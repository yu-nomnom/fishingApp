<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * 釣果テーブルの長さを小数点第一位まで登録できるように修正
 */
class ChangeIntegerToDoubleColumnFishResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE fish_results MODIFY `length` DOUBLE(3,1) COMMENT "長さ(cm)"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fish_results', function (Blueprint $table) {
            $table->integer('length')->nullable(false)->comment('長さ(cm)')->change();
        });
    }
}
