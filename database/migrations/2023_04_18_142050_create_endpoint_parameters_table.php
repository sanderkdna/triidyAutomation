<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEndpointParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endpoint_parameters', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('endpointId')->nullable();
            $table->string('parameter')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('userId')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('endpoint_parameters');
    }
}
