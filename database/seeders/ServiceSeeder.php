<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert(
            [
                'name' => 'Mini-bar',
                'image' => 'img-minibar.png',
                'description' => 'Mini-bar exelente',
                'price' => '$200',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'Toallas Ext.',
                'image' => 'img-toalla.png',
                'description' => 'Mas toallas',
                'price' => '$50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'Licores',
                'image' => 'img-alcohol.png',
                'description' => 'Seleccion de vinos',
                'price' => '$1000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
