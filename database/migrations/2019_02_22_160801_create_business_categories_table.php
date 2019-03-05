<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('raf_business_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('parent_id')->nullable();

            // Constraints declaration
            $table->foreign('parent_id')
                ->references('id')
                ->on('raf_business_categories')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('BusinessCategories');
    }
}
