<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Inventory;
use App\Models\Promotion;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\InventoryImport;
use App\Models\TemporaryInventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Console\Migrations\RollbackCommand;

use function PHPUnit\Framework\isNull;

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
    public $searchTerm;
    public $search;

    public function __construct()
    {
        $this->pages_by_query =10;
    }

    /** Index presenta formulario para los filtros */
    public function inventory(Request $request,$language,$dealer_id){

        if($request->make && count($request->make) == 1 && $request->make[0] == null ){
            $request->make = null;
        }

        if($request->year && count($request->year) == 1 && $request->year[0] == null ){
            $request->year = null;
        }

        if($request->body && count($request->body) == 1 && $request->body[0] == null ){
            $request->body = null;
        }

        $this->mileage_from = $request->mileage_from;
        $this->mileage_to = $request->mileage_to;


        if(!$this->mileage_from){
            $this->mileage_from =0;
        }

        if(!$this->mileage_to){
            $this->mileage_to =999999;
        }

        session()->put('locale', $language);
        App::setLocale(session()->get('locale'));
        session(['inventory_url'  =>  url()->full()]);

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

        if($request->make){
            $search_make = $request->make;
        }

        if($request->body){
            $search_body = $request->body;
        }

        if($request->year){
            $search_year = $request->year;
        }

        if ($request->make || $request->body || $request->year) {
            $vehicles = $this->read_vehicles($request);
        } else {
            $searchTerm = '%' . $request->search . '%';
            $vehicles = Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->Fullsearch($searchTerm)
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        $makesList  =  $this->fill_combos('make');
        $yearsList  =  $this->fill_combos('year');
        $bodiesList =  $this->fill_combos('body');
        $mileage_from = $this->mileage_from;
        $mileage_to   = $this->mileage_to;
        return view('inventory.inventory_page',compact('makesList','yearsList','bodiesList',
                                                'search_make','search_body','search_year','mileage_from','mileage_to',
                                                'title_dealer','dealer_id',
                                                'vehicles'));
    }


    public function importExportView()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

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
        $records = TemporaryInventory::paginate(10);
        return view('inventory_import_export_view',compact('records'));
    }

    public function inventory_import(){
        try {
            TemporaryInventory::truncate();

            Excel::import(new InventoryImport,request()->file('file'));

            $records = TemporaryInventory::paginate(10);
            return view('inventory_import_export_view',compact('records'))->with('message',__('Inventory has been Imported'));
            return back()->with('message',__('Inventory has been Imported'))->compact('records');

        } catch (Throwable $e) {
            report($e);
            return back()->with(['error',__('Inventory was not Imported'),]);
        }
    }

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
                                ->where('dealer_id',$this->dealer_id)
                                ->wherein('year',$whereyear) //Solo anio
                                ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                                ->orderby('make')
                                ->orderby('year')
                                ->orderby('body')
                                ->paginate($this->pages_by_query);
        }

        // (B) Axo y Marca
        if(count($whereyear) && count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
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
                            ->where('dealer_id',$this->dealer_id)
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('year',$whereyear)
                            ->wherein('make',$wheremake)
                            ->wherein('body',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (D) Marca
        if(!count($whereyear) && count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->wherein('make',$wheremake) //Solo Marca
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (E) Marca y Tipo
        if(!count($whereyear) && count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('make',$wheremake)
                            ->wherein('body',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (F) Axo-TIpo
        if(count($whereyear) && !count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->wherein('year',$whereyear)
                            ->wherein('body',$wherebody)
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (G) Solo Tipo
        if(!count($whereyear) && !count($wheremake) && count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->wherein('body',$wherebody) //solo body
                            ->whereBetween('mileage', [$this->mileage_from,$this->mileage_to])
                            ->orderby('make')
                            ->orderby('year')
                            ->orderby('body')
                            ->paginate($this->pages_by_query);
        }

        // (Todos) sin axo-marca-tipo
        if(!count($whereyear) && !count($wheremake) && !count($wherebody)){
            return Inventory::whereNotNull('stock')
                            ->where('dealer_id',$this->dealer_id)
                            ->whereBetween('mileage', [$request->mileage_from,$request->mileage_to])
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

    public function show(Request $request,$language,Inventory $vehicle){
        session()->put('locale', $language);
        App::setLocale(session()->get('locale'));
        $promotions = Promotion::language(App::currentLocale())->get();

        return view('inventory.vehicle_record',compact('vehicle','promotions'));
    }

    /**
     * 1) Obtiene de que ubicaciones tiene inventario
     * 2) Recorre el arreglo de ubicaciones y por cada una:
     *      A) Borra los registros de la localizacion
     *      B) Selecciona de Temporary_inventories los registros de una ubicación
     *      B) Recorre los registros obtenidos del inventario temporal x cada uno
     *          (a) Crea registro en inventories
     * 3) Al terminar de recorrer todas las ubicaciones hace un TRUNCATE a Temporary_inventories
     */

    public function confirm_update_inventory(){
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
        TemporaryInventory::truncate();
        return redirect()->route('inventoryimportExportView');
    }

    private function create_inventory_record(array $temporary_inventory_records){
        foreach($temporary_inventory_records as $temporary_inventory_record ){
            Inventory::create($temporary_inventory_record);
        }
    }
}