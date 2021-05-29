<?php


class VotoModel
{

    private $id;
    private $id_votacion;
    private $id_partido;
    private $id_voto_senado;
    private $instante_creacion;
    private $tipo_votacion;


    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'ofertante' => $this->ofertante,
            'puesto' => $this->puesto,
            'descripcion' => $this->descripcion,
            'requisitos' => $this->requisitos,
            'fecha_publicacion' => $this->fecha_publicacion,
            'contacto' => $this->contacto
        );
    }

    function __construct($id, $ofertante, $puesto, $descripcion, $requisitos, $fecha_publicacion, $contacto){

        $this->id = $id;
        $this->ofertante = $ofertante;
        $this->puesto = $puesto;
        $this->descripcion = $descripcion;
        $this->requisitos = $requisitos;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->contacto = $contacto;

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param positive-int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOfertante()
    {
        return $this->ofertante;
    }

    /**
     * @param mixed $ofertante
     */
    public function setOfertante($ofertante)
    {
        $this->ofertante = $ofertante;
    }

    /**
     * @return mixed
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * @param mixed $puesto
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    /**
     * @return mixed
     */
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    /**
     * @param mixed $requisitos
     */
    public function setRequisitos($requisitos)
    {
        $this->requisitos = $requisitos;
    }

    /**
     * @return mixed
     */
    public function getFechaPublicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * @param mixed $fecha_publicacion
     */
    public function setFechaPublicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    /**
     * @return mixed
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * @param mixed $contacto
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }
    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

}