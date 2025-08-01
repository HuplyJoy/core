<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HttpResponses::success(Area::active()->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return HttpResponses::success($area);
    }
}
