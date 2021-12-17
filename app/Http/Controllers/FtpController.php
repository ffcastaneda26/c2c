<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Inventory;

use App\Imports\InventoryImport;

use App\Models\TemporaryInventory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ftpConnectionController;

class FtpController extends Controller
{

    public $ftpconnection;
    public $files = ["dealermade_coast2coast.csv","dealermade_crossroads.csv"];

    public function __construct()
    {
        $this->ftpconnection = New ftpConnectionController(env('APP_FTP_SERVER'),env('APP_FTP_USER'),env('APP_FTP_PASSWORD'));
    }

   // Request $request,$dealer_id
    public function inventory_ftp_inventory(){
        if($this->ftpconnection->ftpLogin()){
            ftp_pasv($this->ftpconnection->ftp, TRUE);
            TemporaryInventory::truncate();
            try {
                foreach($this->files as $file){
                    if(!$this->get_file($file,$file)){
                        return "Ha habido error al intentar descar archivo $file";
                    }
                    Excel::import(new InventoryImport,$file);
                }
                $this->copy_temporal_to_definitive_inventory();
                TemporaryInventory::truncate();
                $this->ftpconnection->ftp_close();
            } catch (Throwable $e) {
                dd($e);
                return __('Some files could not have been downloaded');
            }
        }
    }

    private function get_file($source,$destination){
        return ftp_get( $this->ftpconnection->ftp, $destination, $source, FTP_BINARY);
    }


    private function copy_temporal_to_definitive_inventory(){
        $locations = DB::table('temporary_inventories')->select('dealer_id')->distinct()->get()->toArray();
        if(count($locations) == 2 ){
            Inventory::truncate();
            $temporary_inventory_records = TemporaryInventory::all()->toArray();
            $this->create_inventory_record($temporary_inventory_records);
        }else{
            foreach($locations as $location ){
                Inventory::where('dealer_id',$location->dealer_id)->delete();
                $temporary_inventory_records = TemporaryInventory::where('dealer_id',$location->dealer_id)->get()->toArray();
                $this->create_inventory_record($temporary_inventory_records);

            }
        }
    }


    private function create_inventory_record(array $temporary_inventory_records){
        foreach($temporary_inventory_records as $temporary_inventory_record ){
            Inventory::create($temporary_inventory_record);
        }
    }

}
