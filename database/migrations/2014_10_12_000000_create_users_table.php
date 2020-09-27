<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();

			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable()->comment('data, email verificado em?');
			$table->string('password');
			$table->rememberToken();

			$table->string('access_token', 400)->nullable()->comment('tamanho minimo 332');
			$table->string('api_token')->nullable();
			$table->boolean('is_admin')->nullable()->default(0)->comment('é admin?');
			$table->boolean('is_active')->nullable()->default(0)->comment('está ativo?');
			$table->datetime('last_login_at')->nullable()->comment('data, último login em?');
			$table->tinyInteger('must_change_passwd', 0)->default(0)->comment('deve mudar a senha?');
			$table->dateTime('passwd_changed_at')->nullable()->comment('data, senha alterada em?');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}