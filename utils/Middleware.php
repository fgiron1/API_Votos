<?php

use Gac\Routing\Request;
use Particle\Filter\Filter;

class Middleware
{
    //Imagino que después de hacer $request->send(['']);
    public function check_vote_format(Request $request){

        $body = $request->get('body');

        $validator = new JsonSchema\Validator;

        VotacionModelHandler

        $validator->validate($data, (object)['$ref' => 'file://' . realpath('../schemas/votoNacionalAutonomicoSchema.json')]);

        $body_decoded = json_decode($body);

        //Obtenemos el tipo de votacion y escogemos uno de los 3 filtros

        $filtroNacional = new Filter();

        $filtroNacional->value('id_elecciones');
        $filtroNacional->value('id_partido');
        $f->values([''])->trim();

        //1. Check if is json file
        //2. Parse it into an array.
        //3. Filter it and send it. Request class performs json_encode() in send method




        $request->send();

    }

}