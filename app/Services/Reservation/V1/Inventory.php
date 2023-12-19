<?php

namespace App\Services\Reservation\V1;

use App\Enums\ReservationStatusEnum;
use App\Models\Bicycle;
use App\Services\Reservation\V1\Contract\InventoryInterface;

class Inventory implements InventoryInterface
{
    protected Bicycle $bicycle;

    /**
     * @param Bicycle $bicycle
     */
    public function __construct(Bicycle $bicycle)
    {
        $this->bicycle = $bicycle;
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function Inventory(string $date): mixed
    {
        $inventory = $this->bicycle->inventory;
        $reservation =(int) $this->bicycle->reservations()
            ->whereNot('status', ReservationStatusEnum::CANCEL->value)
            ->where(function ($query) use ($date) {
                $query->whereDate('start', '<=', $date)
                ->whereDate('end', '>=',$date);
            })->sum('quantity');

        return max($inventory-$reservation, 0);
    }
}
