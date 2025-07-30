<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponses;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HttpResponses::success([
            "openapi"=>"3.1.0",
            "info"=>[
                "title"=>env('APP_NAME','Core'),
                "version"=>env('APP_VERSION','1.0.0'),
                "description"=>env('APP_DESCRIPTION','API gateway'),
            ],
            "servers"=>[
                ["url"=>env('APP_URL','http://localhost:8000').'/api/'.env('LATEST_APP_PATH','v1'),],
            ]
        ]);
    }
}
