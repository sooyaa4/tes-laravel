<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ajis',
            'email' => 'ajis@mail.com',
            'password'  => Hash::make('password'),
            'uuid' => Str::uuid()->toString()
        ]);

        User::create([
            'name' => 'Remi',
            'email' => 'remi@mail.com',
            'password'  => Hash::make('password'),
            'uuid' => Str::uuid()->toString()
        ]);
    }
}
