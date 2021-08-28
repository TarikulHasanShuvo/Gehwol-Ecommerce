<?php

namespace Database\Seeders;

use App\Models\ProductBlCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBlCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blCategoies = [
            ['name' => 'GEHWOL RETAIL'],
            ['name' => 'GEHWOL PROFFESS'],
            ['name' => 'Gehwol ProfProd'],
            ];
        ProductBlCategory::insert($blCategoies);
    }
}
