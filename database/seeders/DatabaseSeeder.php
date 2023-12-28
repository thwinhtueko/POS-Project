<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'Male',
            'role' => 'admin',
            'phone' => '09422439820',
            'address' => 'myitkyina',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
