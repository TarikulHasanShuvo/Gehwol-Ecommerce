<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ProductBlCategorySeeder::class,
            ProductRangeSeeder::class,
            ProductTypeSeeder::class,
        ]);
        DB::table('users')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'customer@gmail.com',
            'phone' => '01736123149',
            'business_name' => 'Jhon Doe',
            'customer_number' => '13424234',
            'city' => 'Rome',
            'state' => 'Italy',
            'postal_code' => '1203',
            'password' => Hash::make('customer'),
            'type' => 'customer',
            'created_at' => date("Y-m-d h:i"),
            'updated_at' => date("Y-m-d h:i"),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Alex',
            'last_name' => 'Hales',
            'email' => 'esthetician@gmail.com',
            'phone' => '01736123149',
            'business_name' => 'Jhon Doe',
            'customer_number' => '13424234',
            'city' => 'Milan',
            'state' => 'Italy',
            'postal_code' => '1203',
            'password' => Hash::make('esthetician'),
            'type' => 'esthetician',
            'created_at' => date("Y-m-d h:i"),
            'updated_at' => date("Y-m-d h:i"),
        ]);

        DB::table('admin_users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'status' => 'admin',
            'created_at' => date("Y-m-d h:i"),
            'updated_at' => date("Y-m-d h:i"),
        ]);
    }
}
