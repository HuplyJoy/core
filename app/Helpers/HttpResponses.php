<?php declare(strict_types=1);

namespace App\Helpers;

use App\Enums\HttpStatusCode;
use Illuminate\Http\JsonResponse;

class HttpResponses{
    static function success($data, $message=null, $code=HttpStatusCode::Ok, $status=HttpStatusCode::Success) : JsonResponse {
        return response()->json([
            "status" => $status->value,
            "description" => $status->readableName(),
            "message" => $message,
            "data" => $data
        ], $code->value);
    }

    static function error($data, $message=null, $code=null, $status=HttpStatusCode::UnexpectedErrorOccurred) : JsonResponse {
        return response()->json([
            "status" => $status->value,
            "description" => $status->readableName(),
            "message" => $message,
            "data" => $data
        ], $code->value ?? 400);
    }
}
