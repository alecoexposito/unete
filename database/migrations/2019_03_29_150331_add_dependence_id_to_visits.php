<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDependenceIdToVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raf_visits', function (Blueprint $table) {
            $table->unsignedInteger("dependence_id");
            $table->foreign('dependence_id')
                ->references('id')
                ->on('raf_dependencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raf_visits', function (Blueprint $table) {
            //
        });
    }
}
