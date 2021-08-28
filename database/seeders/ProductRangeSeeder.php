<?php

namespace Database\Seeders;

use App\Models\ProductRange;
use Illuminate\Database\Seeder;

class ProductRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranges = [
            ['name' => 'Classic'],
            ['name' => 'Fusskraft'],
            ['name' => 'Gerlach Preperations'],
            ['name' => 'Med'],
            ['name' => 'Miscellaneous'],
            ['name' => 'Nail Repair System'],
            ['name' => 'Polymer and Plaster Protective Pads'],
            ['name' => 'Professional'],
            ['name' => 'Soft Feet'],
            ['name' => 'Special Preparations'],
        ];
        ProductRange::insert($ranges);
    }
}
