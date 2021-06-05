<?php

use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;
//require_once '/var/www/API_-Votos_bueno/utils/AuthSingleton.php';
//require_once '/var/www/API_-Votos_bueno/handler/CuentaUsuarioHandler.php';

include_once "/var/www/API_-Votos_bueno/vendor/autoload.php";

//require_once '../../../simplesaml/lib/_autoload.php';

class HomeController
{

    private static Simple $auth;
    private static CuentaUsuarioHandler $cuentasHandler;

    public function __construct(){

        self::$auth = AuthSingleton::getInstance();
        self::$cuentasHandler = new CuentaUsuarioHandler();
    }

    //En ambos métodos se hashea. Sólo se usa RSA en el de votar


    public function registro(Request $request){


        $body = $request->get('body');

        $body_decoded = json_decode($body);

        $user_hash = password_hash($body_decoded['usuario'], PASSWORD_BCRYPT);
        $pwd_hash = password_hash($body_decoded['password'], PASSWORD_BCRYPT);

        self::$cuentasHandler->crearCuentaUsuario($user_hash, $pwd_hash);

    }


    public function login(Request $request){

        $auth = AuthSingleton::getInstance();

        $auth->requireAuth([
            'ErrorURL' => 'https://spserver.westeurope.cloudapp.azure.com/failure',
            'ReturnTo' => 'https://spserver.westeurope.cloudapp.azure.com/success'
        ]);

        try {
            SimpleSAML\Session::getSessionFromRequest()->cleanup();
        } catch (Exception $e) {
            echo 'Error!' . $e->getMessage();
        }

    }

    public function success(Request $request){

        $request->send(['message' => 'Login successful']);

    }

    public function failure(Request $request){

        $request->send(['message' => 'Login failed']);

    }


}
