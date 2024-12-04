<?php

namespace App\Helpers;

class Response
{
    public static function json($data, $status = 200)
    {
        header('Content-Type: application/json', true, $status);
        echo json_encode($data);
        exit;
    }

    public static function notFound($message = 'Resource not found')
    {
        self::json(['message' => $message], 404);
    }
}
