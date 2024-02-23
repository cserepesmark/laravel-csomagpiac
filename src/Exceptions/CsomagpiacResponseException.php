<?php

namespace Cserepesmark\LaravelCsomagpiac\Exceptions;

use Exception;
use Throwable;

class CsomagpiacResponseException extends Exception
{
    protected array $errors;

    public function __construct($message = "", $code = 0, Throwable $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
