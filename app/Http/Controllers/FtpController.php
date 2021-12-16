<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $files = ["dealermade_coast2coast.csv","dealermade_crossroads.csv"];
            foreach($files as $file){
                if(!$this->get_file($file,$file)){
                    return "Ha habido error al intentar descar archivo $file";
                }else{
                    $return = true;
                }
            }
        }
    }

    private function get_file($source,$destination){
        return ftp_get( $this->ftpconnection->ftp, $destination, $source, FTP_BINARY);
      }

}
