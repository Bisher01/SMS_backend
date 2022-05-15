<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('code');
            $table->string('nationality');
            $table->string('phone');
            $table->string('email');
            $table->string('jop');
            $table->foreignId('blood_id')->constrained('bloods')->cascadeOnDelete();
            $table->foreignId('religion_id')->constrained('religtions')->cascadeOnDelete();
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
        Schema::dropIfExists('parents');
    }
}
