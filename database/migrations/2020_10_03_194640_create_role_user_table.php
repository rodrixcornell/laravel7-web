<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_user', function (Blueprint $table) {
			// $table->id();

			$table->foreignId('role_id')->index();
			$table->foreignId('user_id')->index();

			$table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
			$table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
			$table->unique(['role_id', 'user_id'], 'role_user_foreign');

			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('role_user', function (Blueprint $table) {
			$table->dropForeign(['role_id', 'user_id']);
		});
		Schema::dropIfExists('role_user');
	}
}
