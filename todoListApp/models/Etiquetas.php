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
class Etiquetas extends Model{
    
   
    protected static $table = "etiquetas";
    private $id;
    private $nombre;

    function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
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

    function setId($id) {
        $this->id = $id;
    }


    function setNombre($nombre) {
        $this->nombre = $nombre;
    }





}
