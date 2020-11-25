<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->increments('operation_log_id');
            $table->integer('driver_id')->unsigned();
            $table->string('operation_description', 100);
            $table->timestamps();

            $table->foreign('driver_id')
                                ->references('driver_id')
                                ->on('drivers')
                                ->onUpdate('cascade')
                                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_logs');
    }
}
