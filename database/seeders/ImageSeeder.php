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
                'name' => 'roti',
                'file' => 'roti-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'pisang',
                'file' => 'pisang-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'susu',
                'file' => 'susu-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name' => 'nasgor',
                'file' => 'nasgor-1231123.jpg',
                'enable' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
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
