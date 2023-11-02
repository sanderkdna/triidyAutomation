<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('userid')->nullable();
            $table->string('flowid')->nullable();
            $table->string('ticketid')->nullable();
            $table->string('last_message')->nullable();
            $table->string('current_node')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
