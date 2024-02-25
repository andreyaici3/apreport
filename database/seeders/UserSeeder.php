<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => "Andrey Andriansyah",
                'email' => "andreyandri90@gmail.com",
                'email_verified_at' => now(),
                'role' => 'superuser',
                'password' => Hash::make("joya_123"), // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Ilham maulana",
                'email' => "ilhamtkj52@gmail.com",
                'email_verified_at' => now(),
                'role' => 'karyawan',
                'password' => Hash::make("joya_123"), // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Dani fathurahman",
                'email' => "dani@gmail.com",
                'email_verified_at' => now(),
                'role' => 'karyawan',
                'password' => Hash::make("joya_123"), // password
                'remember_token' => Str::random(10),
            ],
        ])->each(function($user){
            User::create($user);
        });
    }
}
