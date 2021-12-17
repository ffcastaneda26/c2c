<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FtpController;

Route::get('ftp_inventory',function(){

    $ftpinventory = new FtpController;
    $ftpinventory->inventory_ftp_inventory();
    return 'Buenos dias....  ' . now();
});
