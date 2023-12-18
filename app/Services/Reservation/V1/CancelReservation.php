<?php

namespace App\Services\Reservation\V1;

use App\Enums\ReservationStatusEnum;
use \App\Models\Reservation;
use App\Services\Reservation\V1\Contract\CancelInterface;
use App\Services\Reservation\V1\Contract\CheckCancelStatusInterface;

class CancelReservation implements CancelInterface, CheckCancelStatusInterface
{
    protected Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function cancel()
    {
        $this->reservation->update(['status' => ReservationStatusEnum::CANCEL->value]);
        return $this->reservation;
    }

    public function checkStatus()
    {
        return $this->reservation->status == ReservationStatusEnum::PENDING->value ?
            $this : throw new \Exception('bicycles is delivered', 422);
    }
}
