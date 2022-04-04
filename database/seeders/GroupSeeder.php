<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' => 'Office Staff'],
            ['name' => 'Barn Staff'],
            ['name' => 'Instructors'],
            ['name' => 'Volunteers'],
        ];

        foreach($groups as $group){
            Group::create($group);
        }
    }
}
