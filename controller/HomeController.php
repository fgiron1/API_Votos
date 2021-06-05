<?php


use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;
use phpseclib3\Crypt\AES;

require_once '../../../simplesaml/lib/_autoload.php';

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

        $auth->requireAuth();

    }


}