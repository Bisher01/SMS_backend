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
          //  $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('claasses')->cascadeOnDelete();
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
