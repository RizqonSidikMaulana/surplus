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
        $data = [
            [
                'name' => 'Makanan Berat',
                'description' => 'Kategori Makanan Berat',
                'enable' => true,
            ],
            [
                'name' => 'Makanan Ringan',
                'description' => 'Kategori Makanan Ringan',
                'enable' => true,
            ],
            [
                'name' => 'Camilan',
                'description' => 'Kategori Camilan',
                'enable' => true,
            ],
            [
                'name' => 'Minuman',
                'description' => 'Kategori Minuman',
                'enable' => true,
            ],
            [
                'name' => 'Buah & Sayur',
                'description' => 'Kategori Buah Dan Sayur',
                'enable' => true,
            ]
        ];
        
        DB::table('products')->insert($data);
    }
}
