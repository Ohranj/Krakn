<?php

namespace App\Traits;

use App\Exceptions\ReportInvalidRequestException;
use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    /**
     * 
     */
    public function respond(bool $state = false, string $message, array $data, array $errors, int $status = 200): JsonResponse
    {
        if (!$state) {
            new ReportInvalidRequestException('Unable to authenticate request', $errors);
        }

        return response()->json(['message' => $message, 'data' => $data, 'errors' => $errors], $status);
    }
}
