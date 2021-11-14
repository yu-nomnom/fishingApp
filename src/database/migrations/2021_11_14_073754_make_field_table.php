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
            $table->string('field_name', 200);
            $table->string('prefecture');
            $table->timestamp('created');
            $table->string('created_user_id');
            $table->timestamp('modified');
            $table->string('modified_user_id');
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
