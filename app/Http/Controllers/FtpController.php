<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ftpConnectionController;

class FtpController extends Controller
{
   // Request $request,$dealer_id
    public function ftpDownloadFile(){
        $result = null;
        $ftpconnection = New ftpConnectionController('ftp.dealermade.co','bigredjelly','Gx1rft020K');
        if($ftpconnection->ftpLogin()){
            $source = "dealermade_coast2coast.csv";
            $destination = "dealermade_coast2coast.csv";
            ftp_pasv($ftpconnection->ftp, TRUE);
            $result = ftp_get( $ftpconnection->ftp, $destination, $source, FTP_BINARY) ? "Saved to $destination" : __("Error downloading") . " " . $source;
        }else{
            $result = __('Login failed');
        }

        echo $result;
    }

    public function ftpDownloadFilex(){
    // (A) FTP SETTINGS - CHANGE TO YOUR OWN!
    $ftpconnection = New ftpConnectionController('ftp.dealermade.co','bigredjelly','Gx1rft020K');
        $ftphost = "ftp.dealermade.co";
        $ftpuser = "bigredjelly";
        $ftppass = "Gx1rft020K";

        // (B) CONNECT TO FTP SERVER
        $ftp = ftp_connect($ftphost) or die("Failed to connect to $ftphost");

        // (C) LOGIN & FTP YOGA
        if (ftp_login($ftp, $ftpuser, $ftppass)) {
            $currentDir = ftp_pwd($ftp); // Get current folder
            $files = ftp_nlist($ftp, $currentDir); // List files & folders
            //$ok = ftp_chdir($ftp, "FOLDER"); // Change the current folder

            $source = "dealermade_coast2coast.csv";
            $destination = "dealermade_coast2coast.csv";


            echo ftp_get($ftp, $destination, $source, FTP_BINARY)
                    ? "Saved to $destination"
                    : "Error downloading $source" ;

            dd($files);
        } else { echo "Invalid user/password"; }

        // (D) CLOSE FTP CONNECTION
        ftp_close($ftp);
    }

}


