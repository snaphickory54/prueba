<?php

class Etiquetas_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
    public function getEtiquetas($id){
        
        if($id){
            $act = Etiquetas::getById($id);
            if($act == null){exit("{}");}
            print_r(json_encode($act->toArray()));
        }else{
            print_r(json_encode(Etiquetas::getAll()));
        }
    }

    public function postEtiquetas(){
        $keys = Etiquetas::getKeys();
        unset($keys[0]);
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $act = Etiquetas::instanciate($_POST);
        $r = $act->create();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    public function postMiembros(){
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $act = Etiquetas::getById($_POST['id_actividad']);
        $usr = Usuario::getById($_POST['id_usuario']);

        $id_usuario = $_POST['id_usuario'];
        $id_actividad = $_POST['id_actividad'];
        $usract = Miembros_x_actividad::search("id_actividad = '$id_actividad' AND id_usuario = '$id_usuario'");
        if($usract != null){exit("El usuario ya existe");}
        $act->has_many("miembros_x_actividad", $usr);
        $h = $act->update();
        if($h["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($h));
    }

    public function getListaEtiquetas($id){

        if($id){ 
            $act = Etiquetas::search("id_lista ='$id'");
            if($act == null){exit('[{"empty":"true"}]');}
            print_r(json_encode($act));
        }
    }

    public function deleteMiembros(){
        $_DELETE = $this->_DELETE;
        $id_usuario = $_DELETE['id_usuario'];
        $id_actividad = $_DELETE['id_actividad'];
       $h = Model::deleteAccess("miembros_x_actividad","id_actividad ='$id_actividad' and id_usuario ='$id_usuario'");
        Request::setHeader($status);
        print(json_encode($h));
    }
    
    public function putEtiquetas(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $act = Etiquetas::getById($_PUT["id"]);
        $act->setNombre($_PUT["nombre"]);
        $act->setIdEstado($_PUT["id_estado"]);
        $act->setIdEtiqueta($_PUT["id_etiqueta"]);
        $act->setFecha($_PUT["fecha"]);
        $r = $act->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    
    public function deleteEtiquetas() {
    
        $_DELETE = $this->_DELETE;
        $list = Etiquetas::getById($_DELETE["id"]);
        $list ->delete();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
        
    }


      
}
