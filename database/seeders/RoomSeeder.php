<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert(
            [
                'room_numb' => '10',
                'image' => 'img_1',
                'description' => 'Habitacion exelente para una familia',
                'price' => "$11964",
                'reserv_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('rooms')->insert(
            [
                'room_numb' => '33',
                'image' => 'img_2',
                'description' => 'Habitacion exelente para una sola persona',
                'price' => "$1000",
                'reserv_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
