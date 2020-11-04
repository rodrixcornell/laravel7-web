<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->id();

			$table->string('name')->index();
			$table->string('slug')->unique();
			// $table->string('ident')->unique();
			$table->text('description')->nullable();
			// Default is an int because Laravel will create a TINYINT column
			$table->boolean('active')->default(0); // O padrão é um int porque o Laravel irá criar uma coluna TINYINT
			// Default can be whatever you want really
			$table->integer('level')->default(99); // O padrão pode ser o que você realmente quiser

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
		Schema::dropIfExists('roles');
	}
}
