<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
//supaya bisa db:seed langsung
{
    use WithoutModelEvents;
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        $this->call([RestaurantSeeder::class]);
        $this->call([MenuItemSeeder::class]);
    }

}
