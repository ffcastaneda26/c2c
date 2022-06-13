<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if( $row['created_at']){
            $row['created_at'] =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['created_at']))
                            ->format('Y-m-d H:i:s');
        }else{
            $row['created_at'] = now();
        }

        try {
            if($row['campaign_name'] && $row['name'] && $row['phone'] && $row['email']){
                Lead::create($row);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->with(['error',__('Leads were not imported'),]);
        }

    }

}
