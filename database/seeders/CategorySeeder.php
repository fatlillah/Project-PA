<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
           [ 'name' => 'Outer'],
           [ 'name' => 'Dress'],
           [ 'name' => 'Abaya'],
           [ 'name' => 'Pants'],
           [ 'name' => 'Shirt'],
           [ 'name' => 'Blouse'],
           [ 'name' => 'Setelan'],
           [ 'name' => 'Vest'],
           [ 'name' => 'Tshirt'],
           [ 'name' => 'Crop Top'],
           [ 'name' => 'Kulot'],
           [ 'name' => 'Overall']
        ]);
    }
}
