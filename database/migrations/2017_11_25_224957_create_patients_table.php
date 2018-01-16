<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('form_name');
            $table->string('full_name');
            $table->date('dob');
            $table->string('gender');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('home_phone')->nullable();
            $table->string('cell_phone');
            $table->string('marital_status');
            $table->boolean('is_verified')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
