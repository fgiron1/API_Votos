<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

class EleccionController
{

    private static Simple $auth;
    private static EleccionModelHandler $eleccionHandler;


    public function __construct(){
        self::$auth = AuthSingleton::getInstance();
        self::$eleccionHandler = new EleccionModelHandler();
    }


    public function (){



    }


    public static function getAllEleccionesActivas(Request $request){

        self::$eleccionHandler->getAllEleccionesActivas();

    }



}