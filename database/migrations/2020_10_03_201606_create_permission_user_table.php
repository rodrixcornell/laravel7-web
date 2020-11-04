<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_user', function (Blueprint $table) {
			// $table->id();

			$table->foreignId('permission_id')->index();
			$table->foreignId('user_id')->index();

			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unique(['permission_id', 'user_id'], 'permission_user_foreign');

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
		Schema::create('permission_user', function (Blueprint $table) {
			$table->dropForeign(['permission_id', 'user_id']);
		});
		Schema::dropIfExists('permission_user');
	}
}
