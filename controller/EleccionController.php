<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once "/var/www/API_-Votos_bueno/handler/EleccionModelHandler.php";

class EleccionController
{

    private static Simple $auth;
    private static EleccionModelHandler $eleccionHandler;


    public function __construct(){
        self::$auth = AuthSingleton::getInstance();
        self::$eleccionHandler = new EleccionModelHandler();
    }


    public static function getAllEleccionesActivas(Request $request){

        $results = self::$eleccionHandler->getAllEleccionesActivas();
        $request->send(['results' => $results]);


    }



}