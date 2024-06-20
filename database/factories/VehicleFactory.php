<?php

namespace Database\Factories;

use App\Models\UserVehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand' => Str::random(5) . " " . Str::random(5),
            'model' => Str::random(5) . " " . Str::random(5),
            'number_plate' => Str::random(5),
            'price' => 100,
            'year' => 2005,
            'owner' => UserVehicle::factory(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            // 'email_verified_at' => null,
        ]);
    }
}
