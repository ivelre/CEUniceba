<?php

namespace App\Services\Excel;

class ForeignField
{
    private $foreignColumn = null;
    private $secondaryForeignColumn = null;
    private $class = null;
    private $shouldCache = false;
    public function __construct($foreignColumn, $secondaryForeignColumn, $class, $shouldCache=false)
    {
        $this->foreignColumn = $foreignColumn;
        $this->secondaryForeignColumn = $secondaryForeignColumn;
        $this->class = $class;
        $this->shouldCache = $shouldCache;
    }

    public function getKey()
    {
        return $this->foreignColumn;
    }

    public function getValue($line, &$cache=[])
    {
        if($this->shouldCache)
            return $this->searchForeignKey($line, $cache);
        else
            return $this->searchForeignKey($line);
    }

    private function searchForeignKey($row, &$cache=[])
    {
        $secondaryForeignColumn = $this->secondaryForeignColumn;
        $class = $this->class;
        $foreignKey = $row[$this->foreignColumn];
        $foreignAux = $row[$secondaryForeignColumn] ?? null;
        
        # Check if the foreign key is already present in the row and isn't empty
        if($foreignKey !== '') return $foreignKey;

        # Check if the foreign auxiliar field is present in the row and isn't empty
        if($foreignAux === null || $foreignAux === '') return null;

        # Perform a reverse lookup to check if the foreign key is present in the cache
        else if(array_key_exists($secondaryForeignColumn, $cache) && 
                array_key_exists($foreignAux, $cache[$secondaryForeignColumn])){
            return $cache[$secondaryForeignColumn][$foreignAux];
        }
        else {
            # echo "\nSearching $foreignAux";

            # Query the database to retrieve the foreign key
            $record = $class::where($secondaryForeignColumn, $foreignAux)->first();
            $id = $record ? $record->id : null;

            # Save the foreign key in the cache
            if(array_key_exists($secondaryForeignColumn, $cache)){
                $cache[$secondaryForeignColumn][$foreignAux] = $id;
            }else{
                $cache[$secondaryForeignColumn] = [$foreignAux => $id];
            }
            return $id;
        }
    }
}