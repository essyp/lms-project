<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('student_no');
            $table->unsignedBigInteger('previous_class_id');
            $table->string('previous_class_code');
            $table->string('previous_class_name');
            $table->unsignedBigInteger('next_class_id');
            $table->string('next_class_code');
            $table->string('next_class_name');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('previous_class_id')->references('id')->on('class_groups')->onDelete('cascade');
            $table->foreign('next_class_id')->references('id')->on('class_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_enrollments');
    }
};