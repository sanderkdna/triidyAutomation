<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlowMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_messages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('userid')->nullable();
            $table->string('flowid')->nullable();
            $table->string('message', 1000)->nullable();
            $table->string('node_parent')->nullable();
            $table->string('node_answer')->nullable();
            $table->string('end_pointid')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flow_messages');
    }
}
