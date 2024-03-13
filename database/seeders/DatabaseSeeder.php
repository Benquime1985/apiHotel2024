<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(Service__RoomsSeeder::class);
    }
}
