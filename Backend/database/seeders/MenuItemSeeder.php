<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert menu items for restaurants
        DB::table('menu_items')->insert([
            [
                'menu_item_id' => 1,
                'restaurant_id' => 1,
                'menu_item_name' => 'Nasi Gurih Komplit',
                'menu_item_description' => 'Nasi gurih dengan lauk komplit',
                'menu_item_price' => 15000
,
            ],
            [
                'menu_item_id' => 2,
                'restaurant_id' => 1,
                'menu_item_name' => 'Nasi Gurih Ayam Goreng',
                'menu_item_description' => 'Nasi gurih dengan ayam goreng',
                'menu_item_price' => 12000,
            ],
            [
                'menu_item_id' => 3,
                'restaurant_id' => 2,
                'menu_item_name' => 'Burgerzilla Big Mac',
                'menu_item_description' => 'Burger super besar dengan daging sapi premium',
                'menu_item_price' => 25000,
            ],
        ]);
    }
}
