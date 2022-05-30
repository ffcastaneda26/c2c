<?php
use App\Models\Inventory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FtpController;

Route::get('ftp_inventory',function(){

    $ftpinventory = new FtpController;
    $ftpinventory->inventory_ftp_inventory();
    return 'Buenos dias....  ' . now();
});

Route::get('registra_log',function(){
    logger("Ejecutado a las " . now());
});

Route::get('neoapi',function(){
    $unitArrayc2c =  json_decode(Http::withHeaders([
        'Connection' => 'keep-alive',
        'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ])
    ->get('https://api.neoverify.net/v1/get_recommended_inventory?id=IvViysJTjUGmTcP20P7GflE26') ,true);
    dd($unitArrayc2c);
});

Route::get('server_data',function(){

    foreach($_SERVER as $server => $valor){
        if(is_array($valor)){
            foreach($valor as $v => $vx){
                echo $v . '=' . $vx . '<br>';
            }
        }else{
            echo $server . '=' . $valor . '<br>';
        }

    }
    echo count($_SERVER);
});
