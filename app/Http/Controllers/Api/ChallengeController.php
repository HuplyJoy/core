<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;
use App\Models\Area;
use App\Models\Challenge;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Area $area)
    {
        return HttpResponses::success($area->activeChallenges()->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        return HttpResponses::success($challenge);
    }
}
