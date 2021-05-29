<?php


use SimpleSAML\Auth\Simple;

class HomeController
{

    private static Simple $auth;


    public function __construct(){

        self::$auth = AuthSingleton::getInstance();

    }


}