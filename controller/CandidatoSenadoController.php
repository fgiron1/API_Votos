<?php


use SimpleSAML\Auth\Simple;
use \Gac\Routing\Request;

class CandidatoSenadoController
{

    private static Simple $auth;
    private static CandidatoSenadoModelHandler $candidatoSenadoHandler;

    public function __construct(){

        self::$auth = AuthSingleton::getInstance();
        $candidatoSenadoHandler = new CandidatoSenadoModelHandler();

    }

    public function getAllCandidatosSenado(Request $request){

        if(self::$auth->isAuthenticated()){
            $results = self::$candidatoSenadoHandler->getAllCandidatosSenado();
            $request->send($results);
        }

    }



}