<?php

namespace App\Imports;

use App\Models\Trainee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TraineeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Trainee([
            'name'     => $row['name'],
            'gender'    => $row['gender'],
            'training_id'    => $row['training'],
            'location'    => $row['location'],
            'ls_id'    => $row['ls'],
            'units_id'    => $row['units'],
            'university'    => $row['university'],
            'start_date'    => $row['start_date'],
            'end_date'    => $row['end_date'],
        ]);
    }
}
