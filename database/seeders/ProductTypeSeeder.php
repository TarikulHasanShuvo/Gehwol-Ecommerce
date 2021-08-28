<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Foot Treatment'],
            ['name' => 'Foot cream'],
            ['name' => 'Hand cream'],
            ['name' => 'Bath salts'],
            ['name' => 'Deodorant'],
            ['name' => 'Cream'],
            ['name' => 'File'],
            ['name' => 'Pump'],
            ['name' => 'Bottle'],
            ['name' => 'Foot and toe pads'],
            ['name' => 'Sponge'],
            ['name' => 'Bath'],
            ['name' => 'Foot Scrub'],

        ];
        ProductType::insert($types);
    }
}
