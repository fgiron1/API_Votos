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

    public function votar($id_elecciones, $id_partido, $nombre_1, $nombre_2, $nombre_3, $apellidos_1, $apellidos_2, $apellidos_3,  ){

        //TODO: WIP
        //TODO: Filter input parameters for null values

        /*$params = Array($id_elecciones, $id_partido, $nombre_1, $nombre_2,);
        $query = "EXECUTE dbo.votar ? ? ? ? ? ? ? ?";
        $stmt = sqlsrv_query($this->connection, $query);



        $query = "EXECUTE dbo.CrearCuentaUsuario ? ?";
        $stmt = sqlsrv_query($this->connection, $query, $params);

        if($stmt === false){
            die;
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->connection);

        //Returns false on failed query execution
        return $stmt;*/
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