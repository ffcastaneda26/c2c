<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Inventory;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\InventoryImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Migrations\RollbackCommand;

class InventoryController extends Controller
{

    public $makesList;
    public $yearsList=[];
    public $bodiesList=[];
    public $make,$years,$makes,$bodies=[];
    public $year = [];
    public $body = [];
    public $vehicles=[];
    public $image_urls = [];
    public $mileage_from,$mileage_to;
    public $pages_by_query;
    public $delar_id= null;
    public function __construct()
    {
        $this->pages_by_query =10;

    }

    /** Index presenta formulario para los filtros */
    public function inventory(Request $request,$dealer_id){


        if($dealer_id == 'texas-inventory'){
            $this->dealer_id = 'coast2coast';
            $title_dealer ="Texas Inventory";
        }

        if($dealer_id == 'oklahoma-inventory'){
            $this->dealer_id = 'crossroads';
            $title_dealer ="Oklahoma Inventory";
        }

        $search_make = [];
        $search_body = [];
        $search_year =[];


        if($request->make  ){
            $search_make = $request->make;
        }
        if($request->body  ){
            $search_body = $request->body;
        }

        if($request->year  ){
            $search_year = $request->year;
        }

        if($request->make || $request->body || $request->year  ){
            $vehicles = $this->read_vehicles($request);
        }else{
            $vehicles = Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }


        $makesList  =  $this->fill_combos('make');
        $yearsList  =  $this->fill_combos('year');
        $bodiesList =  $this->fill_combos('body');
        return view('inventory.inventory_page',compact('makesList','yearsList','bodiesList',
                                                  'search_make','search_body','search_year',
                                                  'title_dealer','dealer_id',
                                                  'vehicles'));
    }

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

    // Llena combos recibiendo el atributo o campo
    private function fill_combos($attribute){
        $sql = 'SELECT DISTINCT ' . $attribute . ' as attribute,count(*) as total FROM inventories WHERE ' . $attribute . ' IS NOT NULL AND stock IS NOT NULL GROUP BY '. $attribute . ' ORDER BY ' . $attribute ;
        $results = DB::select($sql);
        $result_array = array();

        foreach($results as $result){
            array_push( $result_array, $result->attribute  . '(' . $result->total . ')');
        }

        return $result_array;

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

    /** Consulta de Inventario */

    // public function query_inventory(Request $request){

    //     $vehicles = $this->read_vehicles($request);

    //     return view('inventory.inventory_list',compact('vehicles'));
    // }

    /** Lee vehículos con los filtros */
    public function read_vehicles(Request $request){

        $wheremake= $this->where_sql($request->make);
        $wherebody= $this->where_sql($request->body);

        $whereyear= $this->where_sql($request->year);

        if(!count($whereyear)){
            $whereyear =[];
        }

        if(!count($wheremake)){
            $wheremake =[];
        }

        if(!count($wherebody)){
            $wherebody =[];
        }

        if(!$this->mileage_from){
            $this->mileage_from =0;
        }

        if(!$this->mileage_to){
            $this->mileage_to =999999;
        }



        /**+--------------------------------+
         * |        | Axo   | Marca | Tipo  |
         * +--------+-------+-------+-------+
         * | Axo    |  A    |   B   |   F   |
         * +--------+-------+-------+-------+
         * | Marca  |  B    |   D   |   E   |
         * +--------+---------------+-------+
         * | Tipo   |  C    |   E   |   G   |
         * +--------+---------------+-------+
         */


            // (A) Solo Axo
        if(count($whereyear) && !count($wheremake) && !count($wherebody)){

            return Inventory::whereNotNull('stock')
                                ->wherein('year',$whereyear)
                                ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                                ->orderby('make')
                                ->orderby('year')
                                ->orderby('body')
                                ->paginate($this->pages_by_query);

        }

        // (B) Axo y Marca
        if(count($whereyear) && count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('year',$whereyear)
                            ->wherein('make',$wheremake)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);

        }

        // (C) Axo - Marca - Tipo
        if(count($whereyear) && count($wheremake) && count($wherebody)){
            $this->vehicles = Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('year',$whereyear)
                            ->wherein('make',$wheremake)
                            ->wherein('make',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (D) Marca
        if(!count($whereyear) && count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('make',$wheremake)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (E) Marca y Tipo
        if(!count($whereyear) && count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('make',$wheremake)
                            ->wherein('make',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (F) Axo-TIpo
        if(count($whereyear) && !count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('year',$whereyear)
                            ->wherein('make',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (G) Solo Tipo
        if(!count($whereyear) && !count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('make',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (Todos) sin axo-marca-tipo
        if(!count($whereyear) && !count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                                ->orderby('make')
                                ->orderby('year')
                                ->orderby('body')
                                ->paginate($this->pages_by_query);
        }


    }


    /** Recibe array de select multiple y regresa array solo con valores */
    private function where_sql($input_array=null){
        $array=[];
        if($input_array && count($input_array)){
            foreach($input_array as $element){
                array_push($array,substr($element,0, strpos($element, '(')));
            }
        }
        return $array;
    }

    /** Lee y regresa el vehículo solicitado */

    public function show(Inventory $vehicle){
        return view('inventory.vehicle_record',compact('vehicle'));
    }

}
