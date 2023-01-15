<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Attendance;
use App\Models\Permission;
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
        // // data tabel role
        // Role::create([
        //     'name' => 'admin'
        // ]);
        // Role::create([
        //     'name' => 'user'
        // ]);

        // // data tabel posisi 
        // Position::create([
        //     'posisi' => 'dosen' 
        // ]);      
        // Position::create([
        //     'posisi' => 'pegawai' 
        // ]);

        // // // tabel data tipe izin 
        // PermissionType::create([
        //     'name' => 'wfh'
        // ]);
        // PermissionType::create([
        //     'name' => 'sakit'
        // ]);
        

        // // // // tabel data jadwal
        // Attendance::create([
        //     'title' => 'jam masuk pegawai',
        //     'position_id' => '2',
        //     'start_time' => '07:00',
        //     'limit_start_time' => '07:10',
        //     'end_time' => '16:00',
        //     'limit_end_time' => '16:10'
        // ]);
        
        // Attendance::create([
        //     'title' => 'jam masuk selain pegawai',
        //     'position_id' => '1',
        // ]);

        // User::create([
        //     'name' => 'Admin',
        //     'role_id' => 1,
        //     'position_id' => 1,
        //     'phone' => '085156327536',
        //     'image'=> 'image',
        //     'address' => Str::random(6),
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        //     ]);
        // User::factory(5)->create();
        // Permission::factory(5)->create();
        Presence::factory(12)->create();
       
    }
}
