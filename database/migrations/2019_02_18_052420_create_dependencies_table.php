<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_dependencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('description');
            $table->boolean('main')->default(false);
            $table->integer('business_id')->unsigned();

            $table->foreign('business_id')
                ->references('id')
                ->on('raf_businesses')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raf_dependencies');
    }
}
