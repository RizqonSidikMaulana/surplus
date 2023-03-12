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
        $date = date('Y-m-d H:i:s');
        $data = [
            [
                'name' => 'Makanan Berat',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Makanan Ringan',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Camilan',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Minuman',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Buah & Sayur',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ];
        
        DB::table('categories')->insert($data);
    }
}
