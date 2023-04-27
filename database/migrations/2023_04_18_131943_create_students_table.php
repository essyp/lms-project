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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('ref', 50)->unique();
            $table->string('student_no', 50)->unique();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('fullname', 50)->nullable();
            $table->string('email', 150)->unique();
            $table->string('phone_number', 20);
            $table->string('gender', 20)->nullable();
            $table->string('parent_name', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('lga', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('status', 50)->default('active');
             $table->string('password')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};