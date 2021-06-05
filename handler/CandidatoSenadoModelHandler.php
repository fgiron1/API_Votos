<?php

require_once "/var/www/API_-Votos_bueno/model/connection/DatabaseModel.php";

class CandidatoSenadoModelHandler
{

    private $connection;

    public function __construct(){
        $this->connection = DatabaseModel::getInstance()->getConnection();
    }

    public function getAllCandidatosSenado(){

        $results = Array();

        $query = "SELECT id, nombre, apellidos FROM Candidatos_senado";
        $stmt = sqlsrv_query($this->connection, $query);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                array_push($results, $row);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;

    }

}