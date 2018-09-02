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
class Miembros_x_actividad extends Model{
    
   
    protected static $table = "miembros_x_actividad";
    private $id_usuario;
    private $id_actividad;

    function __construct($id_usuario, $id_actividad) {
        $this->id_usuario = $id_usuario;
        $this->id_actividad = $id_actividad;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getId_actividad() {
        return $this->id_actividad;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setId_actividad($id_actividad) {
        $this->id_actividad = $id_actividad;
    }





}
