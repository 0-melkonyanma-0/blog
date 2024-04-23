<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DefaultInfoService;
use Illuminate\Http\JsonResponse;

class DefaultInfoController extends Controller
{
    public function __construct(
        private DefaultInfoService $defaultInfoService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json($this->defaultInfoService->getData());
    }
}
