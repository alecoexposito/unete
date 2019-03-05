<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raf_business_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number')->unique();
            $table->integer('default_percent');
            $table->unsignedInteger('dependence_id')->unique();

            $table->foreign('dependence_id')
                ->references('id')
                ->on('raf_dependencies')
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
        Schema::dropIfExists('raf_business_accounts');
    }
}
