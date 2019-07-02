<?php

namespace App\Services\Excel;

class Importer{
    protected function getDataFromRow(array $line, array $fields, array &$cache)
    {
        $data = [];
        foreach($fields as $item) {
            if(is_string($item)) {
                if($line[$item] !== ''){
                    $data[$item] = $line[$item];
                }else throw new RequiredFieldException($item);
            }
            else if($item instanceof OptionalField) {
                $data[$item->getKey()] = $item->getValue($line);
            } 
            else if($item instanceof ForeignField) {
                $data[$item->getKey()] = $item->getValue($line, $cache);
            }
        }

        // dd($data);
        return $data;
    }

    protected function getUserMessage(string $errorCode)
    {
        switch($errorCode) {
            case '23000':   return 'Error de integridad. Verifique columnas obligatorias, valores repetidos y/o llaves fóraneas';
            case '22007':   return 'Fecha inválida';
            case '00001':   return 'Campo obligatorio no encontrado';

            default:        return 'Error desconocido';
        }
    }

    protected function getStatus(array $errors, $imported) 
    {
        return [
            'errorCount'    =>  sizeof($errors), 
            'errors'        =>  $errors, 
            'imported'      =>  $imported
        ];
    }
}