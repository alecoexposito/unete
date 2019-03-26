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

            $table->unsignedInteger('client_account_id');
            $table->unsignedInteger('business_account_id');
            $table->foreign('client_account_id')
                ->references('id')
                ->on('raf_client_accounts')
                ->onDelete('cascade');
            $table->foreign('business_account_id')
                ->references('id')
                ->on('raf_business_accounts')
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
