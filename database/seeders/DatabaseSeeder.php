<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Models\PermissionType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'dosen'
        ]);
        User::create([
            'name' => 'agam',
            'email' => 'agam@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'phone' => '081081081',
            // 'position_id' => 1,
            'image' => 'image',
            'address' => 'address',
        ]);

       

        PermissionType::create([
            'name' => 'wfh'
        ]);

        User::create([
            'name' => 'takim',
            'email' => 'takim@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'role_id' => 2,
            'phone' => '081081081',
            // 'position_id' => 1,
            'image' => 'image',
            'address' => 'address',
        ]);

        Attendance::create([
            'title' => 'jam masuk dosen a',
            'user_id' => '2',
            'title' => 'masuk dosen a',
            'start_time' => '00:00',
            'limit_start_time' => '22:00',
            'end_time' => '00:00',
            'limit_end_time' => '22:00'
        ]);
    }
}
