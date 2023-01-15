<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lat = '-8.2941'; // latitude of centre of bounding circle in degrees
        $long = '114.3069';
        return [
            //
            'user_id' => 6,
            'attendance_id' => 2,
            'presence_date' => $this->faker->date('y-m-d'),
            'presence_enter_time' => $this->faker->time('H:i:s'),
            'latitude' => $lat,
            'longitude' => $long,
            'presence_out_time' => $this->faker->time('H:i:s')
        ];
    }
}
