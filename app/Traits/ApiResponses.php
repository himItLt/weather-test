<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    protected function sendSuccess(array $result, string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ], 200);
    }

    protected function sendError(string $error, array $errorMessages = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response);
    }
}
