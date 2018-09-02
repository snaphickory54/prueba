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
class Lista extends Model{
    
   
    protected static $table = "lista";
    private $id;
    private $id_propietario;
    private $nombre;

    function __construct($id, $id_propietario, $nombre) {
        $this->id = $id;
        $this->id_propietario = $id_propietario;
        $this->nombre = $nombre;
    }

    private $has_many = array(
        'miembros_x_lista' => array(
         'class' => 'Usuario',
         'my_key' => 'id',
         'other_key' =>'id',
         'join_as' => 'id_lista',
         'join_with' => 'id_usuario',
         'join_table' => 'miembros_x_lista'
            
        ) 
          
      );

      
      private $has_one = array(
        'usuario' => array(
        'class' => 'Usuario',
        'join_as' => 'id_propietario',
        'join_with' => 'id'
        )
       );

    public function getMyVars() {
        return get_object_vars($this);
    }
    function getId() {
        return $this->id;
    }
    
    function getIdPropietario() {
        return $this->id_propietario;
    }

    function getNombre() {
        return $this->nombre;
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

    function setIdPropietario($id_propietario) {
        $this->id_propietario = $id_propietario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setHas_many($has_many) {
        $this->has_many = $has_many;
    }

    public function setHas_one($has_one) {
        $this->has_one = $has_one;
    }




}
