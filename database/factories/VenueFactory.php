<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'full_address' => $this->faker->streetAddress,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'category' => 'Private',
            'phone_number' => $this->faker->phoneNumber,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
