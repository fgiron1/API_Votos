<?php


include('Crypt/RSA.php');
use phpseclib3\Crypt\RSA;

class Cypher
{
    public static function encryptData($data, $publicKey) {

        $publicKey = RSA::load(file_get_contents('../../../../simplesaml/keys/public_key.pem'), $password = false);
        $cyphertext = $publicKey->encrypt($data);

        return base64_encode($cyphertext);
    }

}