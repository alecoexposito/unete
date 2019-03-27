<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessClientAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_business_client_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('raf_clients')
                ->onDelete('cascade');
            $table->unsignedInteger('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('raf_businesses')
                ->onDelete('cascade');
            $table->unsignedInteger('client_type_id');
            $table->foreign('client_type_id')
                ->references('id')
                ->on('raf_client_types');
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
        Schema::dropIfExists('business_client_accounts');
    }
}
