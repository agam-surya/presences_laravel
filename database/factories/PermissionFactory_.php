<?php

namespace Database\Factories;

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
            'user_id' => rand(1,5),
            'tanggal_izin' => $this->faker->date('Y-m-d'),
            'description' => $this->faker->word(),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
