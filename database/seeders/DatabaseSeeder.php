<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        // DB::table('users')->insert([
        //     'name' => "Eduardo",
        //     'last_name' => "Cauich",
        //     'email' => "lalo_lego@hotmail.com",
        //     'password' => Hash::make('password'),
        // ]);
    }
}
