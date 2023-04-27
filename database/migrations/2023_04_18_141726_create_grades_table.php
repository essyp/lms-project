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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade_code', 50);
            $table->integer('min_score');
            $table->integer('max_score');
            $table->string('letter_grade',20);
            $table->string('comment_grade', 50);
            $table->string('gpa_grade', 20);
            $table->string('registration_code', 50);
            $table->string('grade_scale_type', 20);
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
        Schema::dropIfExists('grades');
    }
};