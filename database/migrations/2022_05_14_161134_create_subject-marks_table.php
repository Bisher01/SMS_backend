<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('subject-marks', function (Blueprint $table) {
            $table->id();
            $table->string('min');
            $table->string('max');
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
<<<<<<< HEAD:database/migrations/2022_05_14_161134_create_subject-marks_table.php
          //  $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
=======
            $table->foreignId('class_id')->constrained('claasses')->cascadeOnDelete();
>>>>>>> 3355ae71732c4a4b766e9d9cc68b3f98c772a069:database/migrations/2022_05_14_160960_create_subject-marks_table.php
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
        Schema::dropIfExists('subject-marks');
    }
}
