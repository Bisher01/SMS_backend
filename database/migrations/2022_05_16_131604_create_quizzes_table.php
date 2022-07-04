<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('mark');
            $table->foreignId('quiz_name_id')->constrained('quiz_names', 'id')->cascadeOnDelete();
<<<<<<< HEAD
            $table->foreignId('teacher_subject_id')->constrained('teacher__subjects')->cascadeOnDelete();
=======
            $table->foreignId('C_Cr_T_S_id')->constrained('claass_classroom_teacher_subject', 'id')->cascadeOnDelete();
            $table->foreignId('season_id')->constrained('seasons')->cascadeOnDelete();
>>>>>>> b1ba2322a525c655ab498132a1fd383e593db9d1
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
        Schema::dropIfExists('quizzes');
    }
}
