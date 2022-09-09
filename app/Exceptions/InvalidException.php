<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class InvalidException extends ValidationException
{

    public static function forInvalid($message)
    {
        return static::withMessages([
            'message' => [$message]
        ]);
    }

    public static function forInvalidPackageAvailable($message)
    {
        return static::withMessages([
            'email' => [$message],
            'link' => 'Buy',
            'button' => 'buyclasses'
        ]);
    }
}
