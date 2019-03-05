<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_client_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number')->unique();

            $table->unsignedInteger('client_id')->unique();
            $table->foreign('client_id')
                ->references('id')
                ->on('raf_clients')
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
        Schema::dropIfExists('raf_client_accounts');
    }
}
