<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    protected $message;

    public function __construct($message = "User not found")
    {
        $this->message = $message;
        parent::__construct($this->message, Response::HTTP_NOT_FOUND);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->message], Response::HTTP_NOT_FOUND);
    }
}
