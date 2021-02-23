<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('computers', function (Blueprint $table) {
			$table->id();
			$table->string('processor')->nullable();
			$table->string('ram')->nullable();
			$table->string('storage')->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->unsignedSmallInteger('number');
			$table->smallInteger('control')->nullable()->default(0);
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
		Schema::dropIfExists('computers');
	}
}
