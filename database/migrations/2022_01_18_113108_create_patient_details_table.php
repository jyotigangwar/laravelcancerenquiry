<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->Integer('state_id')->default(0);
            $table->Integer('city_id')->default(0);
            $table->string('address')->nullable();
            $table->string('pincode',10)->nullable();
            $table->Integer('cancer_id')->default(0);
            $table->Integer('status')->default(0)->comment('0=>new,1=>locked');
            $table->Integer('doctor_id')->default(0);
            $table->softdeletes();
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
        Schema::dropIfExists('patient_details');
    }
}
