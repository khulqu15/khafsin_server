<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function handleException(Exception $e): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
        ], $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ? Response::HTTP_NOT_FOUND : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
