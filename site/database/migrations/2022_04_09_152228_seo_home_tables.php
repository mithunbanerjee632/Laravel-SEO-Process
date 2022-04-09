<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_home',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title',1000);
            $table->string('share_title',1000);
            $table->string('description',1000);
            $table->string('keywords',1000);
            $table->string('page_img',1000);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
