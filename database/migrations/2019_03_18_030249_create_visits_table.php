<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_client_id');
            $table->foreign('business_client_id')
                ->references('id')
                ->on('raf_business_client_accounts')
                ->onDelete('cascade');
            $table->dateTime('visited_at');
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
        Schema::dropIfExists('visits');
    }
}
