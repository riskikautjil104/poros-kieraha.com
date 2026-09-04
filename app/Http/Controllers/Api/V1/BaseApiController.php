<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * Return a standardized success response.
     */
    public function sendResponse(mixed $data, string $message = 'Success', int $code = 200, array $extra = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];

        if (!empty($extra)) {
            $response = array_merge($response, $extra);
        }

        return response()->json($response, $code);
    }

    /**
     * Return a standardized error response.
     */
    public function sendError(string $error, int $code = 404, array $errorMessages = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Return a standardized paginated response using a Resource class.
     */
    public function sendPaginatedResponse($paginator, string $resourceClass, string $message = 'Success'): JsonResponse
    {
        $items = $resourceClass::collection($paginator->items());

        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $items,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'has_more'     => $paginator->hasMorePages(),
            ],
        ]);
    }
}
