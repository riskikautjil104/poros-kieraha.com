<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * Authenticate user from Bearer Token or request.
     */
    protected function getAuthenticatedUser(Request $request): ?User
    {
        $token = $request->bearerToken();
        if ($token) {
            $parts = explode('.', $token);
            if (count($parts) === 2) {
                [$encodedPayload, $signature] = $parts;
                $expectedSignature = hash_hmac('sha256', $encodedPayload, config('app.key'));
                if (hash_equals($expectedSignature, $signature)) {
                    $data = json_decode(base64_decode($encodedPayload), true);
                    if (is_array($data) && isset($data['id'], $data['exp']) && $data['exp'] >= time()) {
                        return User::find($data['id']);
                    }
                }
            }
        }

        if (auth()->check()) {
            return auth()->user();
        }

        if ($request->filled('user_id')) {
            return User::find($request->input('user_id'));
        }

        return null;
    }

    /**
     * Generate HMAC signed auth token for mobile API.
     */
    public static function generateToken(User $user): string
    {
        $payload = json_encode([
            'id'    => $user->id,
            'email' => $user->email,
            'exp'   => time() + (86400 * 60), // 60 days
        ]);
        $encodedPayload = base64_encode($payload);
        $signature = hash_hmac('sha256', $encodedPayload, config('app.key'));
        return $encodedPayload . '.' . $signature;
    }
}
