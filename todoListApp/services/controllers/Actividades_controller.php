<?php

class Actividades_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
    public function getActividades($id){
        
        if($id){
            $act = Actividades::getById($id);
            if($act == null){exit("{}");}
            print_r(json_encode($act->toArray()));
        }else{
            print_r(json_encode(Actividades::getAll()));
        }
    }

    public function postActividades(){
        $_PARAMS = json_decode(file_get_contents('php://input'),true);
        $act = Actividades::instanciate($_PARAMS);
        $r = $act->create();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    public function postMiembros(){
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $act = Actividades::getById($_POST['id_actividad']);
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

    public function getActividadMiembros($id){
        $usract = Miembros_x_actividad::search("id_actividad = '$id'");
        if($usract == null){exit('[{"empty":"true"}]');}
        Request::setHeader($status);
        print_r(json_encode($usract));
    }

    public function getListaActividades($id){

        if($id){ 
            $act = Actividades::search("id_lista ='$id'");
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
    
    public function putActividades(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $act = Actividades::getById($_PUT["id"]);
        $act->setNombre($_PUT["nombre"]);
        $act->setIdEstado($_PUT["id_estado"]);
        $act->setIdEtiqueta($_PUT["id_etiqueta"]);
        $act->setFecha($_PUT["fecha"]);
        $r = $act->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    
    public function deleteActividades() {
    
        $_DELETE = $this->_DELETE;
        $list = Actividades::getById($_DELETE["id"]);
        $list ->delete();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
        
    }


      
}
