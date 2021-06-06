<?php


class VotoModel
{

    private $id;
    private $id_eleccion;
    private $id_voto_partido;
    private $id_voto_senado;
    private $instante_creacion;

    /**
     * VotoModel constructor.
     * @param $id
     * @param $id_eleccion
     * @param $id_voto_partido
     * @param $id_voto_senado
     * @param $instante_creacion
     */

    public function __construct($id, $id_eleccion, $id_voto_partido, $id_voto_senado, $instante_creacion)
    {
        $this->id = $id;
        $this->id_eleccion = $id_eleccion;
        $this->id_voto_partido = $id_voto_partido;
        $this->id_voto_senado = $id_voto_senado;
        $this->instante_creacion = $instante_creacion;
    }


    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'id_eleccion' => $this->id_eleccion,
            'id_voto_partido' => $this->id_voto_partido,
            'id_voto_senado' => $this->id_voto_senado,
            'instante_creacion' => $this->instante_creacion
        );
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdEleccion()
    {
        return $this->id_eleccion;
    }

    /**
     * @param mixed $id_eleccion
     */
    public function setIdEleccion($id_eleccion): void
    {
        $this->id_eleccion = $id_eleccion;
    }

    /**
     * @return mixed
     */
    public function getIdVotoPartido()
    {
        return $this->id_voto_partido;
    }

    /**
     * @param mixed $id_voto_partido
     */
    public function setIdVotoPartido($id_voto_partido): void
    {
        $this->id_voto_partido = $id_voto_partido;
    }

    /**
     * @return mixed
     */
    public function getIdVotoSenado()
    {
        return $this->id_voto_senado;
    }

    /**
     * @param mixed $id_voto_senado
     */
    public function setIdVotoSenado($id_voto_senado): void
    {
        $this->id_voto_senado = $id_voto_senado;
    }

    /**
     * @return mixed
     */
    public function getInstanteCreacion()
    {
        return $this->instante_creacion;
    }

    /**
     * @param mixed $instante_creacion
     */
    public function setInstanteCreacion($instante_creacion): void
    {
        $this->instante_creacion = $instante_creacion;
    }



}