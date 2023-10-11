<?php

namespace App\Exceptions;

use Exception;

class InvalidAccountNumberException extends Exception
{
    protected $message = 'Invalid account number.';
    protected $code = 422;
}
