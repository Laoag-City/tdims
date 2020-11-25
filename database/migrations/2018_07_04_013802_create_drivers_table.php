<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('driver_id');
            $table->integer('valid_year_id')->unsigned();
            $table->string('driver_first_name', 40);
            $table->string('driver_middle_initial', 2)->nullable();
            $table->string('driver_last_name', 30);
            $table->string('driver_suffix_name', 4)->nullable();
            
            $table->string('id_no', 5);
            $table->boolean('is_city_driver');
            //$table->string('sidecar_no', 8);
            $table->string('address', 80);
            $table->boolean('sex');
            $table->string('blood_type', 2);
            $table->string('height', 5);
            $table->string('weight', 3);
            $table->date('date_of_birth');
            $table->string('place_of_birth', 40);
            $table->string('civil_status', 9);
            $table->string('emergency_name', 80);
            $table->string('emergency_address', 80)->nullable();
            $table->string('emergency_no', 13)->nullable();
            $table->string('id_control_no');
            //$table->date('date_issued');
            //$table->string('or_no', 9);
            $table->string('picture_path', 30)->nullable();
            $table->timestamps();

            $table->foreign('valid_year_id')
                                ->references('valid_year_id')
                                ->on('valid_years')
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
        Schema::dropIfExists('drivers');
    }
}
