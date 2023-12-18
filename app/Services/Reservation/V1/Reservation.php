<?php

namespace App\Services\Reservation\V1;

use App\Enums\ReservationStatusEnum;
use App\Models\Bicycle;
use App\Services\Reservation\V1\Contract\ActiveInterface;
use App\Services\Reservation\V1\Contract\hasInventoryInterface;
use App\Services\Reservation\V1\Contract\ReservationInterface;

class Reservation implements ReservationInterface, ActiveInterface, hasInventoryInterface
{
    protected Bicycle $bicycle;
    protected int $count;
    protected $startDate;
    protected $endDate;

    public function __construct(Bicycle $bicycle, int $count)
    {
        $this->bicycle = $bicycle;
        $this->count = $count;
    }

    public function hasInventoryInDate(string $startDate, string $endDate)
    {
        $totalReserved = (int)$this->bicycle->reservations()
            ->whereNot('status', ReservationStatusEnum::CANCEL->value)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start', [$startDate, $endDate])
                    ->OrWhereBetween('end', [$startDate, $endDate]);
            })->sum('quantity');

        $overallInventory = max($this->bicycle->inventory - $totalReserved, 0);

        if ($overallInventory >= $this->count) {
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            return $this;
        }
        return throw new \Exception("Doesn't have inventory", 404);
    }

    public function reservation()
    {
        return $this->bicycle->reservations()->create([
            'user_id' => auth()->user()->id,
            'start' => $this->startDate,
            'end' => $this->endDate,
            'quantity' => $this->count,
            'status' => ReservationStatusEnum::PENDING->value,
        ]);
    }

    public function active()
    {
        return $this->bicycle->is_active ? $this : throw new \Exception('bicycle inactive', 404);
    }
}
