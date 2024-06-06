<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Talita dress',
                'stock' => 3,
                'net_price' => 150000,
                'selling_price' => 200000,
                'category_id' => 2,
            ],
            [
                'name' => 'Honey overall',
                'stock' => 3,
                'net_price' => 60000,
                'selling_price' => 110000,
                'category_id' => 12,
            ],
            [
                'name' => 'Irregular shirt',
                'stock' => 3,
                'net_price' => 70000,
                'selling_price' => 120000,
                'category_id' => 5,
            ],
            [
                'name' => 'Bow vest',
                'stock' => 9,
                'net_price' => 80000,
                'selling_price' =>102000,
                'category_id' => 8,
            ],
            [
                'name' => 'pamela dress',
                'stock' => 3,
                'net_price' => 165000,
                'selling_price' => 215000,
                'category_id' => 2,
            ],
            [
                'name' => 'Sweet blouse',
                'stock' => 9,
                'net_price' => 110000,
                'selling_price' => 160000,
                'category_id' => 6,
            ],
            [
                'name' => 'Sweet blouse',
                'stock' => 9,
                'net_price' => 110000,
                'selling_price' => 160000,
                'category_id' => 10,
            ],
            [
                'name' => 'Suhayla abaya',
                'stock' => 3,
                'net_price' => 250000,
                'selling_price' => 300000,
                'category_id' => 3,
            ],
        ]);
    }
}
