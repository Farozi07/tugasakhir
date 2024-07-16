<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $findRole = Role::where('name','admin')->first();
        User::create([
            'role_id' => $findRole->id,
            'name' => 'admin',
            'email' => 'BPSDM23@gmail.com',
            'password' => bcrypt('bpsdm23'),
        ]);
    }
}
