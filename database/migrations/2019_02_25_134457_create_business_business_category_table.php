<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBusinessCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_business_category', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('business_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('business_id')
                ->references('id')
                ->on('raf_businesses');
            $table->foreign('category_id')
                ->references('id')
                ->on('raf_business_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_business_category');
    }
}
