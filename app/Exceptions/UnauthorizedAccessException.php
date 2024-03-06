<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedAccessException extends Exception
{
    public function render($request)
    {
        return redirect()->back()->with(['status' => 'error', 'message' => "You do not have permission to access this resource."]);
    }
}
