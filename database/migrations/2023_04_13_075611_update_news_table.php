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
        Schema::table("news",function(Blueprint $blueprint){
            $blueprint->bigInteger("category_id")
                ->unsigned()
                ->index()
                ->nullable();

            $blueprint->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('SET NUll')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("news",function(Blueprint $blueprint){

            $blueprint->dropForeign("category_id");

            $blueprint->dropColumn("category_id");

        });
    }
};
