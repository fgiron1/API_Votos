<?php

require_once "/var/www/API_-Votos_bueno/model/connection/DatabaseModel.php";
require_once '/var/www/API_-Votos_bueno/model/PartidoModel.php';

class PartidoModelHandler
{

    private $connection;

    public function __construct(){
        $this->connection = DatabaseModel::getInstance()->getConnection();
    }


    public function getPartidosById($id_partido){

        $results = Array();

        $query = "SELECT id, nombre FROM Votos_partido WHERE id = ?";

        //Binding parameters and executing query
        $stmt = sqlsrv_query($this->connection, $query, $id_partido);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($partido = sqlsrv_fetch_object($stmt, 'PartidoModel')){
                array_push($results, $partido);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;

    }

    public function getAllPartidos(){

        $results = Array();

        $query = "SELECT id, nombre FROM Votos_partido";
        $stmt = sqlsrv_query($this->connection, $query);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($partido = sqlsrv_fetch_object($stmt, 'PartidoModel')){
                array_push($results, $partido);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;

    }

}
