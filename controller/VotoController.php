<?php



//use GuzzleHttp\Psr7\Request;
use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once '../../../simplesaml/lib/_autoload.php';
require_once "../vendor/autoload.php";


class VotoController
{

    private static Simple $auth;
    private static VotosModelHandler $votoHandler;

    public function __construct(){

        self::$auth = AuthSingleton::getInstance();
        self::$votoHandler = new VotosModelHandler();

    }

    /**
     * Vote endpoint
     *
     * Sólo accesible tras la autenticación del usuario.
     * Recibe la información del voto encriptada, que se desencripta y verifica.
     * La verificación consiste en un filtrado del fichero JSON : debe contener exactamente los campos que se esperan, en función del tipo de votación que sea.
     * Se controlarán, a su vez, los valores de cada campo, ya sean valores predefinidos (Partidos, consultable), o bien libres (candidatos del senado).
     * Si pasa el filtrado, se persiste en la base de datos Votos, si no, devuelve un código de error.
     *
     * Inputs
     *
     * \Gac\Routing\Request $Request
     *
     * Output
     *
     *
     *
     */
    public function vote(Request $Request){

        if(self::$auth->isAuthenticated()){
            //1. Open connection to the database
            //2. Parse and sanitize request object's body
            //3. Proccess JSON and persist sent data
        } else {
            //Not authenticated:
        }

    }

    /*
     * Authentication endpoint
     *
     */

    public function auth(Request $Request){

        self::$auth->requireAuth();

    }

}