<?php


use SimpleSAML\Auth\Simple;
use \Gac\Routing\Request;

require_once('/var/www/API_-Votos_bueno/handler/CandidatoSenadoModelHandler.php');

class CandidatoSenadoController
{

    private static Simple $auth;
    private static CandidatoSenadoModelHandler $candidatoSenadoHandler;

    public function __construct(){

        self::$auth = AuthSingleton::getInstance();
        self::$candidatoSenadoHandler = new CandidatoSenadoModelHandler();

    }

    public function getAllCandidatosSenado(Request $request){

        if(self::$auth->isAuthenticated()){
            $results = self::$candidatoSenadoHandler->getAllCandidatosSenado();
            $request->send($results);
        }

    }



}