<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name' => 'Eduardo',
			'last_name' => 'Cauich Herrera',
			'email' => 'lalo_lego@hotmail.com',
			'password' => \bcrypt('password'),
		])->assignRole('Admin');

		User::create([
			'name' => 'Julia',
			'last_name' => 'Villalobos Reyes',
			'email' => 'villalobosreyesjulia@gmail.com',
			'password' => \bcrypt('password'),
		])->assignRole('Client');
	}
}
