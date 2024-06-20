<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminImagePath = $this->storeImage('assets/images/profile/avatar.png');
        $kasirImagePath = $this->storeImage('assets/images/profile/avatar.png');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'areya@admin.com',
            'password' => bcrypt('areya123'),
            'profile_image' => $adminImagePath
        ]);
        $admin->assignRole('admin');

        $kasir = User::create([
            'name' => 'kasir',
            'email' => 'ila@gmail.com',
            'password' => bcrypt('12345ila'),
            'profile_image' => $kasirImagePath
        ]);
        $kasir->assignRole('kasir');
    }

    /**
     * 
     *
     * @param string $imagePath
     * @return string
     */
    private function storeImage($imagePath)
    {
        $imageName = basename($imagePath);
        $absoluteImagePath = public_path($imagePath);

        $imageFullPath = 'images/profile/' . $imageName;
        Storage::put($imageFullPath, file_get_contents($absoluteImagePath));

        return $imageFullPath;
    }
}
