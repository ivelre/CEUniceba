<?php

namespace App\Services\Excel;

use  Rap2hpoutre\FastExcel\FastExcel;


class ChunkedFastExcel extends FastExcel
{
    use ChunkedExportable;

    private $with_header = true;
    private $query;
    private $chunk;
    
    public function __construct($query, $chunk=1000)
    {
        parent::__construct();
        $this->query = $query;
        $this->chunk = $chunk;
    }
}