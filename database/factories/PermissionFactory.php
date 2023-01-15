<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'permission_type_id' => rand(1,2),
            'user_id' => rand(1,3),
            'tanggal_start_izin' => now()->format('Y-m-d'),
            'tanggal_end_izin' => Carbon::parse()->addDay(),
            'description' => $this->faker->word(),
        ];
    }
}
