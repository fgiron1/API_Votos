<?php

use Gac\Routing\Exceptions\CallbackNotFound;
use Gac\Routing\Exceptions\RouteNotFoundException;
use Gac\Routing\Routes;

include_once('utils/Middleware.php');
include_once "vendor/autoload.php";

require_once '/var/simplesaml/lib/_autoload.php';

$routes = new Routes();

try {

    $routes->route('/login', [HomeController::class, 'login'], Routes::GET);
    $routes->route('/registro', [HomeController::class, 'registro'], Routes::POST);
    $routes->route('/partidosConIntegrantes/{int:id_partido}', [PartidoController::class, 'getPartidoIntegrantesById'], Routes::GET);
    $routes->route('/partido/{int:id_partido}', [PartidoController::class, 'getPartidoById'], Routes::GET);
    $routes->route('/partido/', [PartidoController::class, 'getAllPartidos'], Routes::GET);
    $routes->route('/candidatos_senado', [CandidatoSenadoController::class, 'getAllCandidatos'], Routes::GET);
    $routes->route('/momento_cierre', [EleccionController::class, 'getInstanteCierre'], Routes::GET);
    $routes->route('/elecciones_activas', [EleccionController::class, 'getAllEleccionesActivas'], Routes::GET);

    $routes->middleware(['check_vote_format'])
            ->add('/votar', [VotoController::class, 'votar', Routes::POST]);


} catch (RouteNotFoundException $ex) {
    $routes->request->status(404, "Route not found")->send(["error" => ["message" => $ex->getMessage()]]);
} catch (CallbackNotFound $ex) {
    $routes->request->status(404, "Callback method not found")->send(["error" => ["message" => $ex->getMessage()]]);
} catch (Exception $ex) {
    $code = $ex->getCode() ?? 500;
    $routes->request->status($code)->send(["error" => ["message" => $ex->getMessage()]]);
}

