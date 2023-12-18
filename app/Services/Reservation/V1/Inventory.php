<?php

namespace App\Services\Reservation\V1;

use App\Enums\ReservationStatusEnum;
use App\Models\Bicycle;
use App\Services\Reservation\V1\Contract\InventoryInterface;
use Carbon\Carbon;

class Inventory implements InventoryInterface
{
    protected Bicycle $bicycle;

    public function __construct(Bicycle $bicycle)
    {
        $this->bicycle = $bicycle;
    }

    public function Inventory(string $date)
    {
        $inventory = $this->bicycle->inventory;
        $reservation =(int) $this->bicycle->reservations()
            ->whereNot('status', ReservationStatusEnum::CANCEL->value)
            ->whereDate('start', $date)->sum('quantity');

        return max($inventory-$reservation, 0);
    }
}
