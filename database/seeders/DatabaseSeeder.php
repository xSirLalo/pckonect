<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();
		Storage::deleteDirectory('products');
		Storage::makeDirectory('products');

		$this->call(RoleSeeder::class);
		$this->call(UserSeeder::class);
		$this->call(ComputerSeeder::class);

		Category::factory(4)->create();
		Product::factory(100)->create();
		$this->call(ProductSeeder::class);
	}
}
