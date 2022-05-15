<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promote_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('from_academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('to_academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('from_grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('to_grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('from_class_id')->constrained('claasses')->cascadeOnDelete();
            $table->foreignId('to_class_id')->constrained('claasses')->cascadeOnDelete();
            $table->foreignId('from_classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('to_classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->date('promote_date');
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
        Schema::dropIfExists('promote_students');
    }
}
