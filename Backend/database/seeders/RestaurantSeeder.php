<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('restaurants')->insert([
        [
            'restaurant_id' => 1,
            'restaurant_name' => 'Nasi Gurih Bu Priya',
            'restaurant_description' => 'Nasi gurih dengan resep sejak 1957',
            'restaurant_address' => 'Jl. kapuas 5, Kediri',
            'restaurant_phone' => '08116728347',
            'restaurant_cuisine' => 'Nasi Gurih',
        ],[
            'restaurant_id' => 2,
            'restaurant_name' => 'Burgerzilla',
            'restaurant_description' => 'Super besar dan super lezat dengan harga super murah!!!',
            'restaurant_address' => 'Jl. Lakarsantri, Surabaya',
            'restaurant_phone' => '08518800289',
            'restaurant_cuisine' => 'Burger',
        ],
        

        ]);
    }
}
