<?php


use SimpleSAML\Auth\Simple;
use \Gac\Routing\Request;

require_once('/var/www/API_-Votos_bueno/handler/CandidatoSenadoModelHandler.php');

class CandidatoSenadoController
{

    private Simple $auth;
    private CandidatoSenadoModelHandler $candidatoSenadoHandler;

    public function __construct(){

        $this->auth = AuthSingleton::getInstance();
        $this->candidatoSenadoHandler = new CandidatoSenadoModelHandler();

    }

    /**
     * Sólo accesible tras la autenticación del usuario. Envía una petición con todos los candidatos
     * que se presentan al senado en las elecciones del momento, si hay alguno.
     *
     * @param Request $request
     *
     */

    public function getAllCandidatos(Request $request){

        if($this->auth->isAuthenticated()){
            $results = $this->candidatoSenadoHandler->getAllCandidatosSenado();
            $request->send($results);
        }

    }

}