<?php

namespace App\Imports;

use DateTime;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
         $row['created_at'] =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['created_at']))
                        ->format('Y-m-d H:i:s');

        try {
            Lead::create($row);
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->with(['error',__('Leads were not imported'),]);
        }

    }

}
