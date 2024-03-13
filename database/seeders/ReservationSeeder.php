<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert(
            [
                'date_arrive' => '2024/01/20',
                'date_output' => '2024/01/24',
                'Num_pers' => '3',
                'user_id' => 3,
                'state' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('reservations')->insert(
            [
                'date_arrive' => '2024/02/2',
                'date_output' => '2024/02/6',
                'Num_pers' => '1',
                'user_id' => 4,
                'state' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
