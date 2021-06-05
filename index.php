<?php

use Gac\Routing\Exceptions\CallbackNotFound;
use Gac\Routing\Exceptions\RouteNotFoundException;
use Gac\Routing\Request;
use Gac\Routing\Routes;

include_once('utils/Middleware.php');
include_once "vendor/autoload.php";
include_once 'controller/HomeController.php';
require_once '/var/simplesaml/lib/_autoload.php';

$routes = new Routes();

try {

    $routes->add('/', function (Request $request) {
        echo json_encode([ 'message' => 'Hello World' ]);
    });

    //$routes
    //        ->prefix('/partido')
    //        ->route('/', [PartidoController::class, 'getAllPartidos', Routes::GET])



    $routes->add('/login', [HomeController::class, 'login'], Routes::GET);
    $routes->add('/success', [HomeController::class, 'success']);
    $routes->add('/failure', [HomeController::class, 'failure']);
    $routes->add('/registro', [HomeController::class, 'registro'], Routes::POST);
    $routes->add('/partidosConIntegrantes/{int:id_partido}', [PartidoController::class, 'getPartidoIntegrantesById'], Routes::GET);
    $routes->add('/partido/{int:id_partido}', [PartidoController::class, 'getPartidoById'], Routes::GET);
    $routes->add('/partido/', [PartidoController::class, 'getAllPartidos'], Routes::GET);
    $routes->add('/candidatos_senado', [CandidatoSenadoController::class, 'getAllCandidatos'], Routes::GET);
    $routes->add('/momento_cierre', [EleccionController::class, 'getInstanteCierre'], Routes::GET);
    $routes->add('/elecciones_activas', [EleccionController::class, 'getAllEleccionesActivas'], Routes::GET);

    $routes//->middleware(['check_vote_format', Middleware::class])
            ->add('/votar', [VotoController::class, 'votar', Routes::POST]);

    $routes->handle();

} catch (RouteNotFoundException $ex) {
    $routes->request->status(404, "Route not found")->send(["error" => ["message" => $ex->getMessage()]]);
} catch (CallbackNotFound $ex) {
    $routes->request->status(404, "Callback method not found")->send(["error" => ["message" => $ex->getMessage()]]);
} catch (Exception $ex) {
    $code = $ex->getCode() ?? 500;
    $routes->request->status($code)->send(["error" => ["message" => $ex->getMessage()]]);
}

