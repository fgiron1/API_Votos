<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once "/var/www/API_-Votos_bueno/handler/PartidoModelHandler.php";
require_once '/var/www/API_-Votos_bueno/handler/PartidoIntegrantesModelHandler.php';

class PartidoController
{

    private Simple $auth;
    private PartidoModelHandler $partidoHandler;
    private PartidoIntegrantesModelHandler $partidoIntegrantesHandler;

    public function __construct(){

        $this->auth = AuthSingleton::getInstance();
        $this->partidoHandler = new PartidoModelHandler();
        $this->partidoIntegrantesHandler = new PartidoIntegrantesModelHandler();

    }

    public function addPartido(PartidoModel $partido){

    }

    public function removePartido($id){

    }

    public function getPartidoIntegrantesById(Request $request, $id_partido){

        if($this->auth->isAuthenticated()){
            $results = $this->partidoIntegrantesHandler->getPartidoIntegrantes($id_partido);
            $request->send(['results' => $results]);
        }

    }

    public function getPartidoById(Request $request, $id_partido){

        if($this->auth->isAuthenticated()) {
            $results = $this->partidoHandler->getPartidosById($id_partido);
            $request->send(['results' => $results]);
        }

    }

    public function getAllPartidos(Request $request){

        if($this->auth->isAuthenticated()) {
            $results = $this->partidoHandler->getAllPartidos();
            $request->send(['results' => $results]);
        }

    }


}