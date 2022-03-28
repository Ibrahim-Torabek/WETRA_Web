<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'email' => 'admin@wetra.ca',
                'password' => bcrypt('asdasdasd'),
                'is_admin' => 1,
            ]);
        
        User::factory()
            ->count(50)
            ->create();
    }
}
