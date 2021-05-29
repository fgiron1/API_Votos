<?php


use SimpleSAML\Auth\Simple;

class AuthSingleton
{
    private static Simple $entryPoint;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        $entryPoint = new Simple('example-sql');
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$entryPoint == null)
        {
            self::$entryPoint = new Simple();
        }

        return self::$entryPoint;
    }

}