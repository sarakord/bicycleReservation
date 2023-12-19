<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ReservationRequest;
use App\Http\Resources\V1\ReservationResource;
use App\Models\Bicycle;
use App\Services\Reservation\V1\Reservation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    /**
     * @param ReservationRequest $request
     * @param Bicycle $bicycle
     * @return JsonResponse
     * @throws \Exception
     */
    public function reservation(ReservationRequest $request, Bicycle $bicycle): JsonResponse
    {
        $start = Carbon::createFromDate($request->startDate)->startOfDay();
        $end = Carbon::createFromDate($request->endDate)->endOfDay();
        $reservation = (new Reservation($bicycle, $request->count))->active()->hasInventoryInDate($start, $end)
            ->reservation();

        return (new ReservationResource($reservation))
            ->response()
            ->setStatusCode(200);
    }
}
