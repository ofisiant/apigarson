<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'First User',
            'email' => 'first@demo.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Second User',
            'email' => 'second@demo.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Third User',
            'email' => 'third@demo.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Fourth User',
            'email' => 'fourth@demo.com',
            'password' => Hash::make('password'),
        ]);
    }
}
