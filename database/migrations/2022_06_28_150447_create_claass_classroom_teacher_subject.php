<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaassClassroomTeacherSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claass_classroom_teacher_subject', function (Blueprint $table) {
//            $table->id();
            $table->foreignId('t_s_id')->constrained('teacher__subjects', 'id')->cascadeOnDelete();
            $table->foreignId('c_cr_id')->constrained('claass_classrooms', 'id')->cascadeOnDelete();
            $table->primary(['t_s_id', 'c_cr_id']);
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
        Schema::dropIfExists('claass_classroom_teacher_subject');
    }
}
