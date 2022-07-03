<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->integer('mark');
            $table->foreignId('exam_name_id')->constrained('exam_names')->cascadeOnDelete();
            $table->foreignId('subject_mark_id')->constrained('subject_marks')->cascadeOnDelete();

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
        Schema::dropIfExists('exams');
    }
}
