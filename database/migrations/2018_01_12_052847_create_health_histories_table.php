<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('group_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('appointment_patient_condition');
            $table->time('schedule_start_time');
            $table->time('schedule_end_time');
            $table->smallInteger('schedule_estimated_service_time');
            $table->double('schedule_estimated_price_service');
            $table->string('doctor_diagnosis');
            $table->string('doctor_action');
            $table->string('doctor_note')->nullable();
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
        Schema::dropIfExists('health_histories');
    }
}
