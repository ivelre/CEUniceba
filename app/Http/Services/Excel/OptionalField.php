<?php

namespace App\Services\Excel;

class OptionalField
{
    private $key = null;
    private $default = null;
    public function __construct($key, $default=null)
    {
        $this->key = $key;
        $this->default = $default;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue(array $line)
    {
        if(array_key_exists($this->key, $line)) {
            return $line[$this->key] !== '' ? $line[$this->key] : $this->default; 
        }
        
        return $this->default;
    }
}