<?php

    use SimpleSAML\Auth\Simple;

/**
 * Implementación del patrón Singleton sobre el objeto que maneja la autenticación de SimpleSAMLPHP
 * Así, conseguimos un único punto de entrada al proceso de autenticación.
 *
 * Class AuthSingleton
 */
    class AuthSingleton
    {
        private static Simple $entryPoint;

        // The constructor is private
        // to prevent initiation with outer code.
        private function __construct(){}

        // The object is created from within the class itself
        // only if the class has no instance.
        public static function getInstance(): Simple
        {
            //if (self::$entryPoint == null) {
                self::$entryPoint = new Simple('example-sql');
            //}

            return self::$entryPoint;
        }
    }