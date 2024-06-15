<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('production_themes')->insert([
            ['name' => 'Lebaran Series'],
            ['name' => 'Ramadhan Series'],
            ['name' => 'Casual'],
            ['name' => 'Gaun Pesta'],
            ['name' => 'Baju Couple Keluarga']
        ]);
    }
}
