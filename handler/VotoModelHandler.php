<?php


require_once("../model/connection/DatabaseModel.php");
require_once("../model/VotoModel.php");
use Gac\Routing\Request;

class VotosModelHandler
{

    private $connection;

    public function __construct(){
        $this->connection = DatabaseModel::getInstance()->getConnection();
    }

    public function votar(Request $request){



        $query = "EXECUTE dbo.votar ";
        $stmt = sqlsrv_query($this->connection, $query);

    }

    public function getVotoById($id_voto){

        $results = Array();

        $query = "SELECT id, id_eleccion, id_partido, id_votos_senado, instante_creacion FROM Votos WHERE id = ?";
        $stmt = sqlsrv_query($this->connection, $query);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                array_push($results, $row, $id_voto);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;
    }

    public function getAllVotos(){

        $results = Array();

        $query = "SELECT id, id_eleccion, id_partido, id_votos_senado, instante_creacion FROM Votos WHERE id = ?";
        $stmt = sqlsrv_query($this->connection, $query);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                array_push($results, $row, $id_voto);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;
    }

}