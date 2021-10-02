<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Response;

class ApiController
{
    use ValidatesRequests;

    /**
     * @param string $message
     * @param mixed $data
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess(string $message, $data = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError(string $message, string $error, int $code = 400): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            'message' => $message,
            'error'   => $error
        ], $code);
    }
}
