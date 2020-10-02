<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'code' => 'ADMIN',
            'name' => 'Admin'
        ]);

        Role::factory()->create([
            'code' => 'STUDENT',
            'name' => 'Student'
        ]);
    }
}
