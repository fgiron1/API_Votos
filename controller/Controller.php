<?php

use GuzzleHttp\Psr7\Request;

/** This is a Generic Controller. Our controllers will extend it.
 *  By default, all HTTP Verbs will be UNSUPPORTED. So, the controllers
 *  which extend this class will only need to override their supported HTTP Verbs.*/
class Controller
{

    private $client;

    public function __construct(){

        $client = new Client([
           'base_uri' => 'https://https://spserver.westeurope.cloudapp.azure.com',
            'timeout' => 2.0
        ]);

    }

    public function manageGetVerb(Request $request)
    {

        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePostVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePatchVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageDeleteVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageHeadVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageTraceVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageOptionsVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageConnectVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

}