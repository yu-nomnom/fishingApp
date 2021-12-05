<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFishingConsiderationTable extends Migration
{
    /**
     * fishing_considerationテーブルを作成
     * @return void
     */
    public function up()
    {
        Schema::create('fishing_consideration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('consideration')->comment('釣りの考察');
            $table->timestamp('created')->comment('作成時間');
            $table->string('created_user_id', 200)->comment('作成者');
            $table->timestamp('modified')->comment('変更時間');
            $table->string('modified_user_id', 200)->comment('変更者');
            $table->softDeletes();
        });
    }

    /**
     * fishing_considerationテーブルを削除
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fishing_consideration');
    }
}
