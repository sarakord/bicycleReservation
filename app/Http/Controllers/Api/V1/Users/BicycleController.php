<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BicycleCollection;
use App\Models\Bicycle;
use Illuminate\Http\Request;

class BicycleController extends Controller
{
    public function index(Request $request)
    {
        $bicycles = Bicycle::query()->latest()->active()
            ->paginate($request->query('limit') ?? 10);

        return (new BicycleCollection($bicycles))
            ->response()
            ->setStatusCode(200);
    }
}
