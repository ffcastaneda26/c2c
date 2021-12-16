<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\ftpConnectionController;

class FtpController extends Controller
{

    public $ftpconnection;

    public function __construct()
    {
        $this->ftpconnection = New ftpConnectionController(env('APP_FTP_SERVER'),env('APP_FTP_USER'),env('APP_FTP_PASSWORD'));
    }

   // Request $request,$dealer_id
    public function ftpDownloadFiles(){

        if($this->ftpconnection->ftpLogin()){
            ftp_pasv($this->ftpconnection->ftp, TRUE);
            $files = ["dealermade_coast2coastx.csv","dealermade_crossroads.csv"];
            try {
                foreach($files as $file){
                    if(!$this->get_file($file,$file)){
                        return "Ha habido error al intentar descar archivo $file";
                    }
                }
            } catch (Throwable $e) {
                return __('Some files could not have been downloaded');
            }
        }
    }

    private function get_file($source,$destination){
        return ftp_get( $this->ftpconnection->ftp, $destination, $source, FTP_BINARY);
      }

}
