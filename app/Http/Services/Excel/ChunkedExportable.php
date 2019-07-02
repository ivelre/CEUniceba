<?php

namespace App\Services\Excel;

use Box\Spout\Writer\WriterFactory;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\Exportable;

/**
 * Trait Exportable.
 *
 * @property bool $with_header
 * @property \Illuminate\Support\Collection $data
 */
trait ChunkedExportable
{
    use Exportable;

    private function exportOrDownload($path, $function, callable $callback = null)
    {
        $writer = WriterFactory::create($this->getType($path));
        $this->setOptions($writer);
        $writer->$function($path);

        $has_sheets = ($writer instanceof \Box\Spout\Writer\XLSX\Writer || $writer instanceof \Box\Spout\Writer\ODS\Writer);

        $this->query->chunk($this->chunk, function($data) use($writer, $has_sheets, $callback){
            
            $this->data = $data;
            // It can export one sheet (Collection) or N sheets (SheetCollection)
            $data = $this->data instanceof SheetCollection ? $this->data : collect([$this->data]);

            foreach($data as $key => $collection) {
                if ($collection instanceof Collection) {
                    // Apply callback
                    if ($callback) {
                        $collection->transform(function ($value) use ($callback) {
                            return $callback($value);
                        });
                    }
                    // Prepare collection (i.e remove non-string)
                    $this->prepareCollection();
                    // Add header row.
                    if ($this->with_header) {
                        $first_row = $collection->first();
                        $keys = array_keys(is_array($first_row) ? $first_row : $first_row->toArray());
                        $writer->addRow($keys);
                        $this->with_header = false;
                    }
                    $writer->addRows($collection->toArray());
                }
                if (is_string($key)) {
                    $writer->getCurrentSheet()->setName($key);
                }
                if ($has_sheets && $data->keys()->last() !== $key) {
                    $writer->addNewSheetAndMakeItCurrent();
                }
            }
        });
        $writer->close();
    }
}
