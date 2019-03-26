<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitIdToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raf_transactions', function (Blueprint $table) {
            $table->unsignedInteger('visit_id')->nullable();
            $table->foreign('visit_id')
                ->references('id')
                ->on('raf_visits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raf_transactions', function (Blueprint $table) {
            //
        });
    }
}
