<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::create([
            'name' => 'HollyWood',
            'photo' => 'photo.png',
            'salary' => '25',
            'employers' => '4',
            'customer' => 'Əmrah Bədirov',
            'position' => 'Garson',
            'description' => 'Yeni ish elani',
            'status' => '0',
            'start_at' => '2022-06-03 23:44:18.000000'
        ]);

        Work::create([
            'name' => 'Absheron Hotel',
            'photo' => 'photo.png',
            'salary' => '30',
            'employers' => '2',
            'customer' => 'Əmrah Bədirov',
            'position' => 'Garson',
            'description' => 'Yeni ish elani',
            'status' => '0',
            'start_at' => now()
        ]);
    }
}
