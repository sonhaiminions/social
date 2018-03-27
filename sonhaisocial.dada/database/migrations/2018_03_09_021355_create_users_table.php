<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email', 100);
			$table->string('username', 100);
			$table->string('password', 100);

			$table->string('firstname', 100)->nullable();
			$table->string('lastname', 100)->nullable();
			$table->string('avatar', 100)->default('avatar/babyreal.jpg');
			$table->string('location', 100)->default('Vinh, nghe an');
			$table->rememberToken()->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
