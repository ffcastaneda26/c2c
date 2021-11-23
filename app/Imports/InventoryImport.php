<?php

namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'dealer_id'         =>  $row['dealer_id'],
            'vin'               =>  $row['vin'],
            'stock'             =>  $row['stock'],
            'year'              =>  $row['year'],
            'make'              =>  $row['make'],
            'model'             =>  $row['model'],
            'exterior_color'    =>  $row['exterior_color'],
            'interior_color'    =>  $row['interior_color'],
            'mileage'           =>  $row['mileage'],
            'transmission'      =>  $row['transmission'],
            'engine'            =>  $row['engine'],
            'retail_price'      =>  $row['retail_price'],
            'sales_price'       =>  $row['sales_price'],
            'options'           =>  $row['options'],
            'images'            =>  $row['images'],
            'last_updated'      =>  $row['last_updated'],
            'body'              =>  $row['body'],
            'trim'              =>  $row['trim'],
        ]);

    }

}

