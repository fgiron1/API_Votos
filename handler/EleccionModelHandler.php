<?php


use \Gac\Routing\Request;

require_once "/var/www/API_-Votos_bueno/model/connection/DatabaseModel.php";
require_once '/var/www/API_-Votos_bueno/model/EleccionModel.php';

class EleccionModelHandler
{
    private $connection;

    public function __construct(){
        $this->connection = DatabaseModel::getInstance()->getConnection();
    }

    public function getAllEleccionesActivas(){

        $results = Array();

        //We prepare and execute the stored procedure "EleccionesActivasAhora"
        $query = "EXECUTE dbo.EleccionesActivasAhora";
        $stmt = sqlsrv_query($this->connection, $query);


        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($eleccion = sqlsrv_fetch_object($stmt, 'EleccionModel')){
                array_push($results, $eleccion);
            }
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;

    }

}