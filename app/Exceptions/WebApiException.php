<?php

namespace App\Exceptions;

class WebApiException extends \Exception
{
    public function __construct(string $message, int $code = 2000, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
            'code' => $this->code,
            'data' => null
        ]);
    }
}
