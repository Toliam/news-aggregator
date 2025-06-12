<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\ConfirmCodeDTO;
use App\Http\Requests\Auth\ConfirmCodeRequest;
use App\Services\CodeVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ConfirmCodeController extends Controller
{
    public function __construct(
        private readonly CodeVerificationService $service,
    ) {
    }

    public function __invoke(ConfirmCodeRequest $request): JsonResponse
    {
        try {
            $this->service->verify(ConfirmCodeDTO::from($request->validated()));

            return response()->json([
                'message' => 'Account activated. You may now log in.',
            ]);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Invalid or expired code.',
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
