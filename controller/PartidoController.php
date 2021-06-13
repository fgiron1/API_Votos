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

    /**
     * Sólo accesible tras la autenticación del usuario. Devuelve un fichero JSON
     * que contiene la información del partido político cuya id coincide con la
     * especificada en la uri, junto con la de los representantes de ese partido
     *
     * @param Request $request
     * @param $id_partido
     */
    public function getPartidoIntegrantesById(Request $request, $id_partido){

        if($this->auth->isAuthenticated()){
            $results = $this->partidoIntegrantesHandler->getPartidoIntegrantes($id_partido);
            $request->send(['results' => $results]);
        }

    }

    /**
     *
     * Sólo accesible tras la autenticación del usuario. Devuelve un fichero JSON
     * que contiene  el partido político cuya id coincide con la que se indica en la URI.
     *
     * @param Request $request
     * @param $id_partido
     */
    public function getPartidoById(Request $request, $id_partido){

        if($this->auth->isAuthenticated()) {
            $results = $this->partidoHandler->getPartidosById($id_partido);
            $request->send(['results' => $results]);
        }

    }

    /**
     * Sólo accesible tras la autenticación del usuario. Devuelve un fichero JSON
     * que contiene todos los partidos políticos que participan en las elecciones del momento, si hay alguno.
     *
     * @param Request $request
     */
    public function getAllPartidos(Request $request){

        if($this->auth->isAuthenticated()) {
            $results = $this->partidoHandler->getAllPartidos();
            $request->send(['results' => $results]);
        }

    }


}