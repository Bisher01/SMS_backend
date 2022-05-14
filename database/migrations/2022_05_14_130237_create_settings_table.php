<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('email');
<<<<<<< HEAD:database/migrations/2022_05_14_130237_create_settings_table.php
            $table->integer('phone');
=======
            $table->string('phone');
>>>>>>> 3355ae71732c4a4b766e9d9cc68b3f98c772a069:database/migrations/2022_05_14_121816_create_settings_table.php
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('addresses')->cascadeOnDelete();
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
        Schema::dropIfExists('settings');
    }
}
