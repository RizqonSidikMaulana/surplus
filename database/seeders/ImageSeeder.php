<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
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
                'id' => 1,
                'name' => 'roti',
                'file' => 'roti-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 2,
                'name' => 'pisang',
                'file' => 'pisang-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 3,
                'name' => 'susu',
                'file' => 'susu-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 4,
                'name' => 'nasgor',
                'file' => 'nasgor-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'id' => 5,
                'name' => 'keripik',
                'file' => 'keripik-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ];
        
        DB::table('images')->insert($data);
    }
}
