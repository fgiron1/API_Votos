<?php

use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;
require_once '/var/www/API_-Votos_bueno/utils/AuthSingleton.php';
require_once '/var/www/API_-Votos_bueno/handler/CuentaUsuarioHandler.php';

include_once "/var/www/API_-Votos_bueno/vendor/autoload.php";
include_once "/var/simplesaml/lib/_autoload.php";
include_once "/var/simplesaml/lib/_autoload_modules.php";
require_once "/var/www/API_-Votos_bueno/utils/AuthSingleton.php";


class HomeController
{

    private Simple $auth;
    private CuentaUsuarioHandler $cuentasHandler;
    private $attributes;

    public function __construct(){

        $this->auth = AuthSingleton::getInstance();
        $this->cuentasHandler = new CuentaUsuarioHandler();
    }

    //En ambos métodos se hashea. Sólo se usa RSA en el de votar

    /**
     *
     * Recibe las credenciales de registro y la verifica. La verificación es realizada
     * por un procedimiento en la base de datos la base de datos que comprueba que no exista
     * ninguna otra cuenta que contenga el mismo hash del DNI y que sí sea el de una persona existente.
     * De ser así, crea la cuenta.
     *
     * Precondición: El cuerpo de la petición debe contener la información personal hasheada con el
     * algoritmo SHA-256
     *
     * @param Request $request
     */
    public function verificar(Request $request){

        $body = $request->get('body');
        $body_decoded = json_decode($body);

        $NIF_hash = $body_decoded['NIF_hash'];
        $nombre = $body_decoded['nombre'];
        $apellidos = $body_decoded['apellidos'];
        $fecha_nacimiento = $body_decoded['fecha_nacimiento'];
        $provincia = $body_decoded['provincia'];
        $domicilio = $body_decoded['domicilio'];

        $this->cuentasHandler->verificarInformacion($NIF_hash, $nombre, $apellidos, $fecha_nacimiento, $provincia, $domicilio);

    }

    /**
     *
     * Recibe las credenciales de registro y las persiste en la base de datos Identidades.
     *
     * Precondición: El cuerpo de la petición debe contener un hash (SHA-256) del DNI y otro de la contraseña.
     *               DEBE HABERSE LLAMADO NECESARIAMENTE al endpoint '/verificar' con la información de la
     *               persona cuyo DNI coincide con el introducido antes de llamar a este endpoint
     *
     * @param Request $request
     */

    public function registro(Request $request){

        $body = $request->get('body');

        $body_decoded = json_decode($body);

        $user_hash = password_hash($body_decoded['NIF_hash'], PASSWORD_BCRYPT);
        $pwd_hash = password_hash($body_decoded['password_hash'], PASSWORD_BCRYPT);

        $this->cuentasHandler->crearCuentaUsuario($user_hash, $pwd_hash);

    }


    /**
     *
     * Recibe las credenciales de usuario y se comunica con el Identity Provider para mandar una petición
     * de autenticación, comenzando el flujo SAML. Los detalles de implementación son manejados por la librería
     * simplesamlphp.
     *
     * Precondición: El cuerpo de la petición debe contener un hash (SHA-256) del DNI y otro de la contraseña.
     *
     * @param Request $request
     */

    public function login(Request $request){

        $this->auth->requireAuth([
            'ErrorURL' => 'https://spserver.westeurope.cloudapp.azure.com/failure',
            'ReturnTo' => 'https://spserver.westeurope.cloudapp.azure.com/success'
        ]);

        $this->attributes = $this->auth->getAttributes();
        var_dump($this->attributes);

        try {
            SimpleSAML\Session::getSessionFromRequest()->cleanup();
        } catch (Exception $e) {
            echo 'Error!' . $e->getMessage();
        }

    }

    public function logout(Request $request){

        if($this->auth->isAuthenticated()){
            $this->auth->logout([
                'ReturnTo' => 'https://spserver.westeurope.cloudapp.azure.com/handleLogout'
            ]);
        }
    }


    public function handleLogout(Request $request){

        if($this->auth->isAuthenticated()) {
            $request->send(['logout' => '1']);
        }
    }

    public function success(Request $request){

        if($this->auth->isAuthenticated()) {
            $request->send([
                'message' => 'Login successful',
                'attributes' => $this->attributes
            ]);
        }

    }

    public function failure(Request $request){

        $request->send(['message' => 'Login failed']);

    }


}
