<?php

class Lista_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
    public function getLista($id){
        
        if($id){
            $act = Lista::getById($id);
            if($act == null){exit("{}");}
            print_r(json_encode($act->toArray()));
        }else{
            print_r(json_encode(Lista::getAll()));
        }
    }

    public function getListaUser($id){
        if($id){ 
            $act = Lista::search("id_propietario ='$id'");
            if($act == null){exit("{}");}
            print_r(json_encode($act));
        }
    }

    public function postLista(){
        $_PARAMS = json_decode(file_get_contents('php://input'),true);
        $act = Lista::instanciate($_PARAMS);
        print_r(json_encode($_PARAMS));
        $r = $act->create();

        $usr = Usuario::getById($_POST['id_propietario']);
        $act->has_many("miembros_x_lista", $usr);
        $h = $act->update();
        if($h["error"] == 0){ $status = 201; }else{ $status = 400; }
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    public function postMiembros(){
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $act = Lista::getById($_POST['id_lista']);
        $usr = Usuario::getById($_POST['id_usuario']);

        $id_usuario = $_POST['id_usuario'];
        $id_lista = $_POST['id_lista'];
        $usract = Miembros_x_lista::search("id_lista = '$id_lista' AND id_usuario = '$id_usuario'");
        if($usract != null){exit("El usuario ya existe");}
        $act->has_many("miembros_x_lista", $usr);
        $h = $act->update();
        if($h["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($h));
    }
    
    public function putLista(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $act = Lista::getById($_PUT["id"]);
        $act->setNombre($_PUT["nombre"]);
        $r = $act->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    public function deleteLista() {
    
        $_DELETE = $this->_DELETE;
        $list = Lista::getById($_DELETE["id"]);
        $list ->delete();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
        
    }


      
}
