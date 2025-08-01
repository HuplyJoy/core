<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\Challenge;
use App\Models\Goal;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Challenge $challenge)
    {
        return HttpResponses::success($challenge->activeGoals()->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        return HttpResponses::success($goal);
    }
}
