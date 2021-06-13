<?php



//use GuzzleHttp\Psr7\Request;
use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

//require_once '../../../simplesaml/lib/_autoload.php';
//require_once "../vendor/autoload.php";
require_once "/var/www/API_-Votos_bueno/handler/VotoModelHandler.php";

class VotoController
{

    private Simple $auth;
    private VotosModelHandler $votoHandler;

    public function __construct(){

        $this->auth = AuthSingleton::getInstance();
        $this->votoHandler = new VotosModelHandler();

    }

    /**
     *
     * Sólo accesible tras la autenticación del usuario. Recibe la información
     * del voto y la verifica. La verificación consiste en una comparación del JSON
     * recibido contra un JSON schema, en función del tipo de votación que sea.
     * Se controlarán, a su vez, los valores de cada campo. Si pasa el filtrado, se
     * persiste en la base de datos Votos, si no, devuelve un código de error.
     *
     * Precondición: El cuerpo de la petición debe estar compuesto por un fichero
     * JSON que contiene la información del voto sin encriptar.
     *
     * Postcondición: La misma cuenta de usuario NO puede volver a votar en las
     * mismas elecciones.
     *
     * @param Request $request
     *
     */
    public function votar(Request $request){

        if($this->auth->isAuthenticated()){

            //TODO: WIP

            /*//Vote information has already been sanitized in
            //middleware function "check_vote_format"

            $body = $request->get('body');
            $body_decoded = json_decode($body);

            //TODO: ExtractParameters

            $this->votoHandler->votar();*/

        } else {
            //Not authenticated:
        }

    }


}