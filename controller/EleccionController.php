<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once "/var/www/API_-Votos_bueno/handler/EleccionModelHandler.php";

class EleccionController
{

    private Simple $auth;
    private EleccionModelHandler $eleccionHandler;


    public function __construct(){
        $this->auth = AuthSingleton::getInstance();
        $this->eleccionHandler = new EleccionModelHandler();
    }


    public function getAllEleccionesActivas(Request $request){

        if($this->auth->isAuthenticated()){
            $results = $this->eleccionHandler->getAllEleccionesActivas();
            $request->send(['results' => $results]);
        }

    }



}