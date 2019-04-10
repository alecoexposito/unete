<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('business_client_id');
            $table->foreign('business_client_id')
                ->references('id')
                ->on('raf_client_accounts')
                ->onDelete('cascade');


            $table->string('ticket');
            $table->float('amount');
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
        Schema::dropIfExists('raf_transactions');
    }
}
