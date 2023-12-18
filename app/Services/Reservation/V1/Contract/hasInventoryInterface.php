<?php

namespace App\Services\Reservation\V1\Contract;

interface hasInventoryInterface
{
    public function hasInventoryInDate(string $startDate, string $endDate);
}
