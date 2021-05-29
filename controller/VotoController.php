<?php



//use GuzzleHttp\Psr7\Request;
use Gac\Routing\Request;
use SimpleSAML\Auth\Simple;

require_once '../../../simplesaml/lib/_autoload.php';
require_once "../vendor/autoload.php";


class VotosController
{

    private static Simple $auth;


    public function __construct(){

        $authSingle = AuthSingleton::getInstance();

        self::$auth = $authSingle->getInstance();

    }

    /**
     * Vote endpoint
     *
     * Inputs
     *
     * \Gac\Routing\Request $Request
     *
     * Output
     *
     * This endpoint is only accessible after user authentication.
     * Doesn't redirect to auth endpoint because it doesn't follow the android
     * application flow
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