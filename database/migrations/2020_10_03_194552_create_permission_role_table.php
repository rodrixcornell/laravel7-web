<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_role', function (Blueprint $table) {
			// $table->id();

			$table->foreignId('permission_id')->index();
			$table->foreignId('role_id')->index();

			$table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
			$table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
			$table->unique(['permission_id', 'role_id'], 'permission_role_foreign');

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
		Schema::create('permission_role', function (Blueprint $table) {
			$table->dropForeign(['permission_id', 'role_id']);
		});
		Schema::dropIfExists('permission_role');
	}
}
