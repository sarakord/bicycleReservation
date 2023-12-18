<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ReservationResource;
use \App\Models\Reservation;
use App\Services\Reservation\V1\CancelReservation;

class CancelReservationController extends Controller
{
    public function cancel(Reservation $reservation)
    {
        $reservation = (new CancelReservation($reservation))->checkStatus()->cancel();

        return (new ReservationResource($reservation))
            ->response()
            ->setStatusCode(200);
    }
}
