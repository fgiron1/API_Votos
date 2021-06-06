<?php

require_once "/var/www/API_-Votos_bueno/model/connection/DatabaseModel.php";
require_once '/var/www/API_-Votos_bueno/model/PartidoIntegrantesModel.php';
class PartidoIntegrantesModelHandler
{

    private $connection;

    public function __construct(){
        $this->connection = DatabaseModel::getInstance()->getConnection();
    }

    public function getPartidoIntegrantes($id_partido){

        $results = Array();

        $query = "SELECT Partidos.id, Integ.nombre, Integ.apellidos, Integ.cargo FROM Votos_partido AS Partidos INNER JOIN Integrantes AS Integ ON Partidos.id = Integ.id_partido WHERE Partidos.id = ?";
        $stmt = sqlsrv_query($this->connection, $query, $id_partido);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($partidoIntegrantes = sqlsrv_fetch_object($stmt, 'PartidoIntegrantesModel')){
                array_push($results, $partidoIntegrantes);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;

    }

}