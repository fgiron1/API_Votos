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


    /**
     * Sólo accesible tras la autenticación del usuario. Envía una petición con un fichero JSON
     * que contiene la información de las elecciones actualmente activas.
     *
     * @param Request $request
     */

    public function getAllEleccionesActivas(Request $request){

        if($this->auth->isAuthenticated()){
            $results = $this->eleccionHandler->getAllEleccionesActivas();
            $request->send(['results' => $results]);
        }

    }



}