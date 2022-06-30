<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSickLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sick_letters', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no')->unique();
            $table->date('transaction_date');
            $table->unsignedBigInteger('clinic_id');
            $table->unsignedBigInteger('medical_staff_id');
            $table->unsignedBigInteger('patient_id');
            $table->tinyInteger('for_relationship')->default(0);
            $table->unsignedBigInteger('patient_relationship_id')->nullable();
            $table->integer('num_of_days');
            $table->unsignedBigInteger('diagnosis_id')->nullable();
            $table->string('remark')->nullable();
            $table->bigInteger('model_reference_id')->nullable();
            $table->string('model_reference_type')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('medical_staff_id')->references('id')->on('medical_staff')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('patient_relationship_id')->references('id')->on('employee_relationships')->onDelete('cascade');
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sick_letters');
    }
}
