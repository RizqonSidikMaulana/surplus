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
        $date = date('Y-m-d H:i:s');
        $data = [
            [
                'name' => 'Roti Sobek',
                'description' => 'Rasa Coklat',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Pisang Ambon',
                'description' => '10 Buah',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Susu UHT',
                'description' => 'Rasa Vanilla',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Nasi Goreng',
                'description' => 'Special,Basic,Seafood',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'Keripik Pisang',
                'description' => 'Rasa Balado, Coklat, BBQ',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ];
        
        DB::table('products')->insert($data);
    }
}
