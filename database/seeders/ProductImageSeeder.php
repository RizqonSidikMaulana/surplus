<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
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
                'product_id' => 1,
                'image_id' => 1,
            ],
            [
                'product_id' => 2,
                'image_id' => 2,
            ],
            [
                'product_id' => 3,
                'image_id' => 3,
            ],
            [
                'product_id' => 4,
                'image_id' => 4,
            ],
            [
                'product_id' => 5,
                'image_id' => 5,
            ],
        ];

        DB::table('product_image')->insert($data);
    }
}
