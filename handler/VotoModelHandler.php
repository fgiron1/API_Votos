<?php


require_once "/var/www/API_-Votos_bueno/model/connection/DatabaseModel.php";
require_once("/var/www/API_-Votos_bueno/model/VotoModel.php");

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
        $stmt = sqlsrv_query($this->connection, $query, $id_voto);

        if($stmt === false){
            die;
        } else {
            //Each row is stored in $results array
            while($voto = sqlsrv_fetch_object($stmt, 'VotoModel')){
                array_push($results, $voto);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;
    }

    public function getAllVotos(){

        $results = Array();

        $query = "SELECT id, id_eleccion, id_partido, id_votos_senado, instante_creacion FROM Votos";
        $stmt = sqlsrv_query($this->connection, $query);

        if($stmt === false){
            die;
        } else {
            //Each row is stored as VotoModel in $results array
            while($voto = sqlsrv_fetch_object($stmt, 'VotoModel')){
                array_push($results, $voto);
            }
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        return $results;
    }

}