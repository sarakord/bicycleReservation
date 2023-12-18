<?php

namespace Database\Factories;

use App\Enums\ReservationStatusEnum;
use App\Models\Bicycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bicycle = Bicycle::query()->active()->inRandomOrder()->first();

        $start = $this->faker->dateTimeBetween('-1 days', '+10 days');
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'bicycle_id' => $bicycle->id,
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +2 days'),
            'status' => $this->randEnum(ReservationStatusEnum::class),
            'quantity' => rand(1, $bicycle->quantity),
        ];
    }

    protected function randEnum($enum)
    {
        $statuses = $enum::cases();
        $values = array_column($statuses, 'value');
        return $values[array_rand($values)];
    }
}
