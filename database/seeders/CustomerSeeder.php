<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            ['name' => '-', 'address' => '-', 'phone' => '-'],
            ['name' => 'Lely', 'address' => 'Bangkal Sumenep', 'phone' => '087850550494'],
            ['name' => 'Olin', 'address' => 'Jl. Griya Mapan Kacongan', 'phone' => '081939349733'],
            ['name' => 'Ayu', 'address' => 'Jl. Raya Bogor', 'phone' => '085259115146'],
            ['name' => 'Nur Eka Oktaviyah', 'address' => 'Jl. Asta Tinggi Kebunagung', 'phone' => '081918096923'],
            ['name' => 'Mita Faradilla', 'address' => 'Jl. Asta Tinggi Kebunagung', 'phone' => '082334239710'],
            ['name' => 'Izza', 'address' => 'Satelit', 'phone' => '085104028647'],
            ['name' => 'Yana', 'address' => 'Pabian', 'phone' => '087875609345'],
        ]);
    }
}
