<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTypeDependencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_client_type_dependences', function (Blueprint $table) {
            $table->increments('id');
            $table->float('global_percent')->nullable();
            $table->float('local_percent')->nullable();

            $table->unsignedInteger('client_type_id');
            $table->foreign('client_type_id')
                ->references('id')
                ->on('raf_client_types')
                ->onDelete('cascade');
            $table->unsignedInteger('dependence_id');
            $table->foreign('dependence_id')
                ->references('id')
                ->on('raf_dependencies')
                ->onDelete('cascade');
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
        Schema::dropIfExists('client_type_dependences');
    }
}
