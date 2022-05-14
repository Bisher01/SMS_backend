/*<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Classes', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('Grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('Classes', function(Blueprint $table) {
			$table->dropForeign('Classes_grade_id_foreign');
		});
	}
}
