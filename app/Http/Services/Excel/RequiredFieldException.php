<?php

namespace App\Services\Excel;

use Exception;

class RequiredFieldException extends Exception{

    public function __construct(string $field, Exception $previous = null){
        parent::__construct("Required field [$field] should not be empty", "00001", $previous);
    }
}