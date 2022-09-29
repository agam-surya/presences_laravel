<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        Role::create([
            'name' => 'admin'
        ]);
        Position::create([
            'name' => 'karyawan'
        ]);
        User::create([
            'name' => 'agam',
            'email' => 'agam@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'phone' => '081081081',
            'position_id' => 1,
            'image' => 'image',
            'address' => 'address',
        ]);
    }
}
