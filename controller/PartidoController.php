<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once "/var/www/API_-Votos_bueno/handler/PartidoModelHandler.php";
require_once '/var/www/API_-Votos_bueno/handler/PartidoIntegrantesModelHandler.php';

class PartidoController
{

    private static Simple $auth;
    private static PartidoModelHandler $partidoHandler;
    private static PartidoIntegrantesModelHandler $partidoIntegrantesHandler;

    public function __construct(){

        self::$auth = AuthSingleton::getInstance();
        self::$partidoHandler = new PartidoModelHandler();
        self::$partidoIntegrantesHandler = new PartidoIntegrantesModelHandler();

    }

    public function addPartido(PartidoModel $partido){

    }

    public function removePartido($id){

    }

    public function getPartidoIntegrantesById(Request $request, $id_partido){

        if(self::$auth->isAuthenticated()){
            $results = self::$partidoIntegrantesHandler->getPartidoIntegrantes($id_partido);
            $request->send(['results' => $results]);
        }

    }

    public function getPartidoById(Request $request, $id_partido){

        if(self::$auth->isAuthenticated()) {
            $results = self::$partidoHandler->getPartidosById($id_partido);
            $request->send(['results' => $results]);
        }

    }

    public function getAllPartidos(Request $request){

        if(self::$auth->isAuthenticated()) {
            $results = self::$partidoHandler->getAllPartidos();
            $request->send(['results' => $results]);
        }

    }


}