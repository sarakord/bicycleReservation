<?php

namespace Tests\Unit;

use App\Models\Bicycle;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BicycleTest extends TestCase
{

    /**
     * @test
     */
    public function bicycle_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('bicycles', ['title', 'inventory', 'is_active', 'created_at', 'updated_at']));
    }

    /**
     * @test
     */
    public function it_can_be_created_with_fillable_attributes()
    {
        $fields = getFillableFieldsWithNullDefault(Bicycle::class);
        $values = array_intersect_key(Bicycle::factory()->definition(), $fields);

        $bicycle = Bicycle::create($values);

        $this->assertDatabaseHas('bicycles', $values);
        $this->assertInstanceOf(Bicycle::class, $bicycle);
    }

    /** @test */
    public function it_has_many_reservation()
    {
        $user1 = User::factory()->create();
        $bicycle = Bicycle::factory()->create();
        $reservation = Reservation::factory()->create([
            'user_id' => $user1->id,
            'bicycle_id' => $bicycle->id,
        ]);

        $bicycleReservations = $bicycle->reservations;

        $this->assertInstanceOf(Reservation::class, $bicycleReservations->first());
        $this->assertEquals($reservation->id, $bicycleReservations->first()->id);
    }
}
