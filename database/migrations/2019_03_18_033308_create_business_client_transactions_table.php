<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessClientTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_business_client_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dependence_account_id');
            $table->foreign('dependence_account_id')
                ->references('id')
                ->on('raf_business_accounts')
                ->onDelete('cascade');
            $table->unsignedInteger('client_account_id');
            $table->foreign('client_account_id')
                ->references('id')
                ->on('raf_business_client_accounts')
                ->onDelete('cascade');
            $table->unsignedInteger('visit_id')->nullable();
            $table->foreign('visit_id')
                ->references('id')
                ->on('raf_visits');

            $table->string('ticket');
            $table->float('amount');

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
        Schema::dropIfExists('business_client_transactions');
    }
}
