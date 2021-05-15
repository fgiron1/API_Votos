<?php


require_once("DatabaseModel.php");

class VotosModelHandler
{
    public static function getOfferById($id){

        OfertaModel $oferta;

        $dao = DatabaseModel::getInstance();
        $connection = $dao->getConnection();

        $query = "SELECT * FROM Ofertas WHERE id = ?";
        $prep_query = $connection->prepare($query);

        $prep_query->bind_param("ssssssi",
            $oferta->set,
            $puesto,
            $descripcion,
            $requisitos,
            $fecha_publicacion,
            $contacto,
            $id));

        $prep_query->execute();
        //TODO: Devolver el recurso

    }

    public static function getAllOffers(){

        $listaOfertas = array();

        $dao = DatabaseModel::getInstance();
        $connection = $dao->getConnection();

        //TODO: Clase de constantes para poner los nombres de las tablas y pon el nombre de las columnas, no *
        $query = "SELECT * FROM Ofertas";
        $prep_query = $connection->prepare($query);
        $prep_query->execute();

        //La información extraída por fetch() se irá almacenando en las siguientes variables:
        $prep_query->bind_result($id, $ofertante, $puesto, $descripcion, $requisitos, $fecha_publicacion, $contacto);
        while($prep_query->fetch()){

            //Se hashean las primary keys para no exponerlas en la URI
            $id = hash_hmac("sha256", $id, "mitesoro");

            //Se instancia un nuevo VotosModel con la información extraída
            $oferta = new VotosModel($id, $ofertante, $puesto, $descripcion, $requisitos, $fecha_publicacion, $contacto);

            //Se añade a la lista a devolver
            $listaOfertas[] = $oferta;
        }

        //TODO: Devolver el recurso

        $connection->close();
    }

    public static function updateOffer($id, VotosModel $offer){

        $dao = DatabaseModel::getInstance();
        $connection = $dao->getConnection();

        $query = "UPDATE Ofertas SET ofertante = ?, puesto = ?, descripcion = ?, requisitos = ?, fecha_publicacion = ?, contacto = ? WHERE id = ?";
        $prep_query = $connection->prepare($query);

        $ofertante = $offer->getOfertante();
        $puesto = $offer->getPuesto();
        $descripcion = $offer->getDescripcion();
        $requisitos = $offer->getRequisitos();
        $fecha_publicacion = $offer->getFechaPublicacion();
        $contacto = $offer->getContacto();

        $prep_query->bind_param("ssssssi", $ofertante,
                                                  $puesto,
                                                       $descripcion,
                                                       $requisitos,
                                                       $fecha_publicacion,
                                                       $contacto,
                                                       $id); //Pasado por parámetros

        return $prep_query->execute();


    }

    public static function insertOffer(VotosModel $offer){

        $dao = DatabaseModel::getInstance();
        $connection = $dao->getConnection();

        $query = "INSERT INTO TABLE Ofertas(ofertante, puesto, descripcion, requisitos, fecha_publicacion, contacto) " .
                 "VALUES (?, ?, ?, ?, ?, ?)";

        $prep_query = $connection->prepare($query);

        $ofertante = $offer->getOfertante();
        $puesto = $offer->getPuesto();
        $descripcion = $offer->getDescripcion();
        $requisitos = $offer->getRequisitos();
        $fecha_publicacion = $offer->getFechaPublicacion();
        $contacto = $offer->getContacto();

        $prep_query->bind_param("ssssss", $ofertante,
                                                 $puesto,
                                                      $descripcion,
                                                      $requisitos,
                                                      $fecha_publicacion,
                                                      $contacto);
        return $prep_query->execute();

    }

    public static function deleteOffer($id){

        $dao = DatabaseModel::getInstance();
        $connection = $dao->getConnection();

        $query = "DELETE FROM Ofertas WHERE id = ?";

        $prep_query = $connection->prepare($query);

        $prep_query->bind_param($id);

        return $prep_query->execute();


    }

    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}