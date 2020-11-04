<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function (Blueprint $table) {
			$table->id();

			$table->string('name')->index();
			$table->string('slug')->unique();
			$table->text('description')->nullable();
			// Default is an int because Laravel will create a TINYINT column
			$table->boolean('active')->default(0); // O padrão é um int porque o Laravel irá criar uma coluna TINYINT

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
		Schema::dropIfExists('permissions');
	}
}
