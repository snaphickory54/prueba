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
class Usuario extends Model {
    
   
    protected static $table = "usuario";
    private $id;
    private $nombre;
    private $email;
    private $clave;

        private $has_many = array(
        'miembros_x_lista' => array(
         'class' => 'Usuario',
         'my_key' => 'id',
         'other_key' =>'id',
         'join_as' => 'id_usuario',
         'join_with' => 'id_lista',
         'join_table' => 'miembros_x_lista'
            
        ) 
          
      );


    function __construct($id, $nombre, $email, $clave) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->clave = $clave;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }


    function getEmail() {
        return $this->email;
    }


    function getClave() {
        return $this->clave;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    public function setHas_many($has_many) {
        $this->has_many = $has_many;
    }

    public function setHas_one($has_one) {
        $this->has_one = $has_one;
    }



}
