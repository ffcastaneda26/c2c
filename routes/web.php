<?php

use App\Http\Livewire\Inventory;
use App\Http\Livewire\Promotions;
use App\Imports\InventoriesImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

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

Route::get('return-back', function() {
    return back()->withInput();
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('importExportView', [InventoryController::class, 'importExportView']);
Route::get('export', [InventoryController::class, 'export'])->name('export');
Route::post('import', [InventoryController::class, 'import'])->name('import');

Route::get('promotions',Promotions::class)->name('promotions');
Route::get('inventory_import', [InventoryController::class, 'inventoryimportExportView'])->name('inventoryimportExportView');
Route::post('inventory_import', [InventoryController::class, 'inventory_import'])->name('inventory_import');
Route::get('inventory_export', [InventoryController::class, 'inventory_export'])->name('inventory_export');
Route::get('inventory/{dealer_id}', [InventoryController::class, 'inventory'])->name('texas-inventory');
Route::get('inventory/show/{vehicle}', [InventoryController::class, 'show'])->name('show_vehicle');
Route::get('confirm_update_inventory', [InventoryController::class, 'confirm_update_inventory'])->name('confirm_update_inventory');

//Route::post('query_inventory', [InventoryController::class, 'query_inventory'])->name('query_inventory');

