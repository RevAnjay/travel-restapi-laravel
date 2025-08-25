<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
     protected static array $response = [
        'status' => 'success',
        'code' => null,
        'message' => null,
        'data' => null
    ];

    public static function success(mixed $data = null, string $message = null, int $status = Response::HTTP_OK)
    {
        self::$response['status'] = 'success';
        self::$response['code'] = $status;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $status);
    }

    public static function error(mixed $data = null, string $message = null, int $status = Response::HTTP_BAD_REQUEST)
    {
        self::$response['status'] = 'failed';
        self::$response['code'] = $status;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $status);
    }
}
