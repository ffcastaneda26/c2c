<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Inventory;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\InventoryImport;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new UsersImport,request()->file('file'));

        return back();
    }


    // Importar Inventario

    public function inventoryimportExportView(){
        return view('inventory_import_export_view');
    }

    public function inventory_import(){


        try {
            Inventory::truncate();

            Excel::import(new InventoryImport,request()->file('file'));

            return back()->with('message',__('Inventory has been Imported'));
        } catch (Throwable $e) {
            report($e);
            return back()->with('message',__('Inventory was not Imported'));
        }


    }
}
