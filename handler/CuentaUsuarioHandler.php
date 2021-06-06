<?php

require_once "/var/www/API_-Votos_bueno/model/connection/IdentityDBModel.php";

class CuentaUsuarioHandler
{
    private $connection;

    public function __construct(){
        $this->connection = IdentityDBModel::getInstance()->getConnection();
    }

    public function crearCuentaUsuario($user_hash, $pwd_hash){

        //No se necesita un "CuentaUsuarioModel"

        $params = array($user_hash, $pwd_hash);

        $query = "EXECUTE dbo.CrearCuentaUsuario ? ?";
        $stmt = sqlsrv_query($this->connection, $query, $params);

        if($stmt === false){
            die;
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        //Returns false on failed query execution
        return $stmt;

    }

}