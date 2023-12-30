<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BicycleCollection;
use App\Models\Bicycle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades;

class BicycleController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
       $bicycles = Facades\Cache::remember('bicycle_list',60, function () use($request){
           return Bicycle::query()->latest()->active()->paginate($request->limit ?? 10);
        });
dd(Facades\Cache::get('bicycle_list'));


        return (new BicycleCollection($bicycles))
            ->response()
            ->setStatusCode(200);
    }
}
