<?php

namespace avalontechsv\idSV\Exceptions;

use Exception;

class InvalidNITException extends Exception
{
    public function __construct()
    {
        parent::__construct('The provided NIT is invalid. NIT must be numeric and have a valid check digit.');
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}";
    }

}