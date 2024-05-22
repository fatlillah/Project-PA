<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = User::create([
            'name' => 'admin',
            'email' => 'areya@admin.com',
            'password' => bcrypt('areya123'),
            'profile_image' => 'assets/images/profile/avatar.png' 
        ]);
        $admin->assignRole('admin');

        $kasir = User::create([
            'name' => 'kasir',
            'email' => 'ila@gmail.com',
            'password' => bcrypt('12345ila'),
            'profile_image' => 'assets/images/profile/avatar.png' 
        ]);
        $kasir->assignRole('kasir');
    }
}
