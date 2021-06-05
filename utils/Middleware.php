<?php

use Gac\Routing\Request;


class Middleware
{
    //Imagino que después de hacer $request->send(['']);
    public function check_vote_format(Request $request){

        $body = $request->get('body');
        $body_decoded = json_decode($body);

        $validator = new JsonSchema\Validator;

        $validator->validate($body_decoded, (object)['$ref' => 'file://' . realpath('../schemas/votoNacionalAutonomicoSchema.json')]);


        $request->send();

    }

}