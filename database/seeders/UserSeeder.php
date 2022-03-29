<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Admin 1',
            'email' => 'super-admin@chitran.in',
            'password' => bcrypt('password'),
        ]);
        $super_admin->assignRole('Super Admin');
    }
}
