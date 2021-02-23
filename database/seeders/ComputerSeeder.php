<?php

namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Computer::create([
			'processor' => 'AMD RYZEN 2400G',
			'ram' => '16 GB',
			'storage' => '500GB',
			'ip_address' => '192.168.100.49',
			'number' => (1),
			'control' => (0),
		]);
	}
}
