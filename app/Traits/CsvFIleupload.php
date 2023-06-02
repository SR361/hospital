<?php

namespace App\Traits;

trait CsvFIleupload
{
    public function getCsvAsArray($file, $keyField = null)
    {
        $rows = array_map('str_getcsv', file($file));
        $rowKeys = array_shift($rows);
        $formattedData = [];
        foreach ($rows as $row) {
            $associatedRowData = array_combine($rowKeys, $row);
            if (empty($keyField)) {
                $formattedData[] = $associatedRowData;
            } else {
                $formattedData[$associatedRowData[$keyField]] = $associatedRowData;
            }
        }

        return $formattedData;
    }
}
