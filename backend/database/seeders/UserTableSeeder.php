<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStudentUser();
        $this->createAdminUser();
    }

    private function createStudentUser() {
        $user = User::factory()->create();
        $role = Role::where('code', 'STUDENT')->firstOrFail();
        UserRole::factory()->create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }

    private function createAdminUser() {
        $user = User::factory()->create();
        $role = Role::where('code', 'ADMIN')->firstOrFail();
        UserRole::factory()->create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }
}
