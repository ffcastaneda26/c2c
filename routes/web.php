<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Livewire\Promotions;
use App\Http\Livewire\Inventories;
use App\Imports\InventoriesImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FtpController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LeadsController;
use App\Models\Inventory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('storage-link',function(){
    if(Auth::user()){
        if(file_exists(public_path('storage'))){
            return public_path('storage') . 'Ya esiste';
        }
        Artisan::call('storage:link');
    }else{
        return 'Sorry You Not Authorized To This Command';
    }
})->middleware('auth');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user = User::find(1);
    $url = URL::temporarySignedRoute('inventario', now()->addMinutes(2), ['user' => $user]);
    return view('dashboard' , compact('user', 'url'));
})->name('dashboard');

Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    App::setLocale(session()->get('locale'));
    return back();
})->name('changelanguage');

Route::get('importExportView', [InventoryController::class, 'importExportView']);
Route::get('export', [InventoryController::class, 'export'])->name('export');
Route::post('import', [InventoryController::class, 'import'])->name('import');

Route::get('promotions',Promotions::class)->name('promotions');
Route::get('inventario', function(Request $request) {
    if (!$request->hasValidSignature()) {
        abort(401);
    }
    $inventario_general = Inventory::all();
    return view('livewire.inventory', compact('inventario_general'));
})->name('inventario');

Route::get('inventory_import', [InventoryController::class, 'inventoryimportExportView'])->name('inventoryimportExportView');
Route::post('inventory_import', [InventoryController::class, 'inventory_import'])->name('inventory_import');
Route::get('inventory_export', [InventoryController::class, 'inventory_export'])->name('inventory_export');
//Route::get('inventory/{dealer_id}', [InventoryController::class, 'inventory'])->name('texas-inventory');
Route::get('inventory/show/{language}/{vehicle}', [InventoryController::class, 'show'])->name('show_vehicle');
Route::get('confirm_update_inventory', [InventoryController::class, 'confirm_update_inventory'])->name('confirm_update_inventory');
Route::get('inventory_ftp_inventory', [FtpController::class, 'inventory_ftp_inventory'])->name('inventory_ftp_inventory');

Route::get('inventory/{language}/{dealer_id}', [InventoryController::class, 'inventory'])->name('inventory');



Route::get('query_leads', [LeadsController::class, 'query_leads'])->name('query_leads');
/** Rutas de prueba */
require 'pruebas.php';

