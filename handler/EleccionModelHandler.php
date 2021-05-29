<?php


use \Gac\Routing\Request;

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
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                array_push($results, $row);
            }
        }

        return $results;

    }

}