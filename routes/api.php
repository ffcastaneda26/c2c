<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LeadsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('inventory/{stock}', [InventoryController::class, 'read_stock'])->name('read_stock');

Route::post('read_leads', [LeadsController::class, 'receive_leads'])->name('read_leads');
Route::get('read_leads', [LeadsController::class, 'get_receive_leads'])->name('read_leads');

Route::get('send_to_neo', [LeadsController::class, 'send_to_neo'])->name('send_to_neo');

