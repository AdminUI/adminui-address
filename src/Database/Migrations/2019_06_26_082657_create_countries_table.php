<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('iso_code2', 2)->nullable();
			$table->string('iso_code3', 3)->nullable();
			$table->string('iso_code3_2', 5)->nullable();
			$table->string('dialing_code', 8)->nullable();
			$table->boolean('postcode')->default(0);
			$table->boolean('tax_exempt')->default(0);
			$table->boolean('is_active')->default(1);
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
		Schema::drop('countries');
	}

}
