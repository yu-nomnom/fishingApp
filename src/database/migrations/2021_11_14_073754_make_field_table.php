<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldTable extends Migration
{
    /**
     * fieldテーブルを作成
     * @return void
     */
    public function up()
    {
        Schema::create('field', function (Blueprint $table) {
            $table->bigIncrements('id');    
            $table->string('field_name', 200)->comment('フィールド名');
            $table->string('prefecture')->comment('都道府県');
            $table->timestamp('created')->comment('作成時間');
            $table->string('created_user_id', 200)->comment('作成者');
            $table->timestamp('modified')->comment('変更時間');
            $table->string('modified_user_id', 200)->comment('変更者');
            $table->softDeletes();
        });
    }

    /**
     * fieldテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field');
    }
}
