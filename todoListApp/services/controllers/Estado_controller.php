<?php

class Estado_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
    public function getEstado($id){

        if($id){
            $act = Estado::getById($id);
            if($act == null){exit("{}");}
            print_r(json_encode($act->toArray()));
        }else{
         
            print_r(json_encode(Estado::getAll()));
        }
    }

    public function postEstado(){
        $keys = Estado::getKeys();
        unset($keys[0]);
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $act = Estado::instanciate($_POST);
        $r = $act->create();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    
    public function putEstado(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $act = Estado::getById($_PUT["id"]);
        $act->setNombre($_PUT["nombre"]);
        $act->setIdEstado($_PUT["id_estado"]);
        $act->setIdEtiqueta($_PUT["id_etiqueta"]);
        $act->setFecha($_PUT["fecha"]);
        $r = $act->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }

    
    public function deleteEstado() {
    
        $_DELETE = $this->_DELETE;
        $list = Estado::getById($_DELETE["id"]);
        $list ->delete();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
        
    }


      
}
