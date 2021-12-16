<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ftpConnectionController extends Controller
{

    var $ftphost;
    var $ftpuser;
    var $ftppass;
    var $ftp;


    public function __construct($ftphost,$ftpuser,$ftppass)
    {
        $this->ftphost = $ftphost;
        $this->ftpuser = $ftpuser;
        $this->ftppass = $ftppass;
        $this->Connect();
    }

    public function Connect(){
        $this->ftp = ftp_connect($this->ftphost) or die("Failed to connect to $this->ftphost");
    }

    public function ftpLogin(){
        return ftp_login($this->ftp, $this->ftpuser, $this->ftppass);
    }

    public function ftpClose(){
        ftp_close( $this->ftp);
    }

}

