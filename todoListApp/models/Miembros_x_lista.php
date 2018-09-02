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
class Miembros_x_lista extends Model{
    
   
    protected static $table = "miembros_x_lista";
    private $id_usuario;
    private $id_lista;

    function __construct($id_usuario, $id_lista) {
        $this->id_usuario = $id_usuario;
        $this->id_lista = $id_lista;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }
    public static function getTable() {
        return self::$table;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getId_lista() {
        return $this->id_lista;
    }

    public static function setTable($table) {
        self::$table = $table;
    }


    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setId_lista($id_lista) {
        $this->id_lista = $id_lista;
    }





}
