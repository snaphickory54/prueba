<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author Usuario
 */
class Actividades extends Model{
    
   
    protected static $table = "actividades";
    private $id;
    private $id_lista;
    private $id_estado;
    private $id_etiqueta;
    private $nombre;
    private $fecha;

    private $has_one = array(
        'lista' => array(
            'class' => 'Lista',
            'join_as' => 'id_lista',
            'join_with' => 'id'
        ),  'estado' => array(
            'class' => 'Estado',
            'join_as' => 'id_estado',
            'join_with' => 'id'
        ),  'etiqueta' => array(
            'class' => 'Etiqueta',
            'join_as' => 'id_etiqueta',
            'join_with' => 'id'
        )
    );

    private $has_many = array(
        'miembros_x_actividad' => array(
         'class' => 'Usuario',
         'my_key' => 'id',
         'other_key' =>'id',
         'join_as' => 'id_actividad',
         'join_with' => 'id_usuario',
         'join_table' => 'miembros_x_actividad'
            
        ) 
          
      );


    function __construct($id, $id_lista, $id_estado ,$id_etiqueta, $nombre, $fecha) {
        $this->id = $id;
        $this->id_lista = $id_lista;
        $this->id_estado = $id_estado;
        $this->id_etiqueta = $id_etiqueta;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }
    function getId() {
        return $this->id;
    }

    function getIdLista() {
        return $this->id_lista;
    }

    function getIdEstado() {
        return $this->id_estado;
    }

    function getIdEtiqueta() {
        return $this->id_etiqueta;
    }

    function getNombre() {
        return $this->nombre;
    }


    function getFecha() {
        return $this->fecha;
    }

    public function getHas_many() {
        return $this->has_many;
    }

    public function getHas_one() {
        return $this->has_one;
    }



    function setId($id) {
        $this->id = $id;
    }

    function setIdLista($id_lista) {
        $this->id_lista = $id_lista;
    }


    function setIdEstado($id_estado) {
        $this->id_estado = $id_estado;
    }

    function setIdEtiqueta($id_etiqueta) {
        $this->id_etiqueta = $id_etiqueta;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHas_many($has_many) {
        $this->has_many = $has_many;
    }

    public function setHas_one($has_one) {
        $this->has_one = $has_one;
    }




}
