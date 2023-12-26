<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BicycleCollection;
use App\Models\Bicycle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BicycleController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $bicycles = Bicycle::query()->latest()->active()
            ->paginate($request->query('limit') ?? 10);

       /* $bicycles = Redis::set('bicycle_list', Bicycle::all());

        dd(
            json_decode(
                \Illuminate\Support\Facades\Redis::get('bicycle_list'),
                true
            )
        );*/

        return (new BicycleCollection($bicycles))
            ->response()
            ->setStatusCode(200);
    }
}
