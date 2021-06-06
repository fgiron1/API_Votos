<?php

use Gac\Routing\Request;

require_once '/var/www/API_-Votos_bueno/vendor/autoload.php';

class Middleware
{
    //Imagino que después de hacer $request->send($results);
    //Le pasarla peticion no al cliente sino a
    public function check_vote_format(Request $request){

        $body = $request->get('body');
        $body_decoded = json_decode($body);

        $validator = new JsonSchema\Validator;

        $results = $validator->validate($body_decoded, (object)['$ref' => 'file://' . realpath('../schemas/votoNacionalAutonomicoSchema.json')]);

        $request->send(['message' => $results]);;


    }

}